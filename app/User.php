<?php

namespace App;

use Analytics;
use Carbon\Carbon;
use App\Models\Product;
use App\Models\UserStore;
use App\Models\Transaction;
use Spatie\Analytics\Period;
use App\Services\PerseoService;
use App\Mail\UserPlanBillCreated;
use App\Services\PaymentezService;
use Laravel\Passport\HasApiTokens;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Crypt;
use Rinvex\Subscriptions\Models\Plan;
use Illuminate\Notifications\Notifiable;
use Rinvex\Addresses\Traits\Addressable;
use Illuminate\Support\Facades\Validator;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use App\Notifications\PasswordResetRequest;
use Overtrue\LaravelFollow\Traits\CanFollow;
use Overtrue\LaravelFollow\Traits\CanFavorite;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Rinvex\Subscriptions\Traits\HasSubscriptions;
use Silber\Bouncer\Database\HasRolesAndAbilities;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements HasMedia
{
	use HasApiTokens, Notifiable;
	use HasRolesAndAbilities;
	use HasMediaTrait;
	use HasSubscriptions;
	use Addressable;
	use CanFollow, CanFavorite;
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'name',
		'password',
		'first_name',
		'last_name',
		'email',
		'phone',
		'gender',
		'dob',
		'country',
		'state',
		'city',
		'facebook_token',
		'facebook_id',
		'google_token',
	];

	protected $appends = array('role', 'avatar_image', 'full_name', 'plan');
	/**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */
	protected $hidden = [
		'password', 'remember_token', 'facebook_token', 'facebook_id', 'google_token',
	];

	/**
	 * The attributes that should be casted to native types.
	 *
	 * @var array
	 */
	protected $casts = [
		'id' => 'integer',
		'first_name' => 'string',
		'last_name' => 'string',
		'email' => 'string',
		'password' => 'string',
		'phone' => 'string',
		'dob' => 'date',
		'gender' => 'string',
		'remember_token' => 'string',
		'country' => 'string',
		'state' => 'string',
		'city' => 'string',
	];

	public $with = [
		'all_media'
	];

	/**
	 * Validation rules.
	 *
	 * @var array
	 */
	public static $rules = [
		'first_name' => ['required', 'string', 'max:255'],
		'last_name' => ['sometimes', 'string', 'max:255'],
		'email' => 'required|email|max:255|unique:users',
		'password' => ['sometimes', 'string', 'min:8'],
		'dob' => 'sometimes|date|before:-18 years',
		'country' => 'sometimes|string',
		'state' => 'sometimes|string',
		'city' => 'sometimes|string',
	];

	public function plans()
	{
		return $this->belongsToMany(Plan::class, 'plan_subscriptions', 'user_id', 'plan_id')->where('user_type', 'App\User');
	}

	public function payment_methods()
	{
		return $this->hasMany(\App\Models\PaymentMethod::class)->where('is_paying', true);
	}

	public function collecting_method()
	{
		return $this->hasOne(\App\Models\PaymentMethod::class)->where('is_collecting', true);
	}

	public function questions()
	{
		return $this->hasMany(\App\Models\Question::class);
	}

	public function notification_settings()
	{
		return $this->hasMany(\App\Models\NotificationSetting::class);
	}

	public function reviews()
	{
		return $this->hasMany(\App\Models\Review::class);
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 **/
	public function store()
	{
		return $this->hasOne(\App\Models\UserStore::class);
	}



	public function followedStores()
	{
		return $this->belongsToMany(UserStore::class, 'followables', 'user_id', 'followable_id')->where('followable_type', 'App\Models\UserStore');
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 **/
	public function coupons()
	{
		return $this->belongsToMany(\App\Models\Coupon::class, 'coupons_users');
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 **/
	public function orders()
	{
		return $this->hasMany(\App\Models\Order::class);
	}

	public function faqs()
	{
		return $this->hasMany(\App\Models\Faq::class);
	}

	public function transactions()
	{
		return $this->hasMany(\App\Models\Transaction::class);
	}

	public function all_media()
	{
		return $this->morphMany('Spatie\MediaLibrary\Models\Media', 'model');
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 **/
	public function wishlist()
	{
		return $this->belongsToMany(\App\Models\Product::class, 'wishlists');
	}

	public function getRoleAttribute()
	{
		return $this->getRoles() && !empty($this->getRoles()) ? $this->getRoles()[0] : 'No role';
	}

	public function getAvatarImageThumbnailAttribute()
	{
		$images = $this->getAllMedia();
		$names = str_replace(" ", "+", $this->full_name);
		$default = 'https://ui-avatars.com/api/?size=128&name=' . $names;

		if (!$images || empty($images)) {
			return $default;
		}

		foreach ($images as $key => $image) {
			if ($image->hasCustomProperty('isAvatar')) {
				return $image->getFullUrl();
			}
		}

		return $default;
	}

	public function getAvatarImageAttribute()
	{
		$images = $this->getAllMedia();
		$names = str_replace(" ", "+", $this->full_name);
		$default = 'https://ui-avatars.com/api/?size=128&name=' . $names;

		if (!$images || empty($images)) {
			return $default;
		}

		foreach ($images as $key => $image) {
			if ($image->hasCustomProperty('isAvatar')) {
				return $image->getFullUrl();
			}
		}

		return $default;
	}

	public function getImagesAttribute()
	{
		$images = $this->getAllMedia();

		if (!$images || empty($images)) {
			return [];
		}

		$imagesNotMain = [];
		foreach ($images as $key => $image) {
			if (!$image->hasCustomProperty('isAvatar')) {
				$imagesNotMain[] = $image->getFullUrl();
			}
		}

		return $imagesNotMain;
	}

	public function getAllMedia()
	{
		return $this->all_media;
	}

	public function saveAvatarImage($path, $isLocalStorage = true)
	{
		if ($isLocalStorage) {
			$this->addMedia(public_path('storage/' . $path))
				->withCustomProperties(['isAvatar' => true])
				->toMediaCollection('avatars');
		} else {
			$this->addMediaFromUrl($path)
				->withCustomProperties(['isAvatar' => true])
				->toMediaCollection('avatars');
		}
	}

	public function getFullNameAttribute()
	{
		return $this->first_name . ' ' . $this->last_name;
	}


	public function getNotificationSetting($typeId)
	{
		return $this->notification_settings()->firstOrCreate(['notification_type_id' => $typeId], [
			'send_email' => true,
			'send_push' => true,
		]);
	}

	public function getPlanAttribute()
	{
		return $this->getPlan();
	}

	public function hasCompleteProfile()
	{
		$messages = [
			'dob.before' => 'Debes tener más de 18 años para tener una cuenta',
			'dob.date' => 'La fecha de nacimiento es obligatoria',
			'first_name.required' => 'El nombre es requerido',
			'last_name.required' => 'El apellido es requerido',
			'state.required' => 'La provincia es requerida',
			'city.required' => 'La ciudad es requerida',
			'gender.required' => 'El género es requerido',
			'dob.required' => 'La fecha de nacimiento es requerida',
		];
		// dd($request->user()->toArray());
		$validator = Validator::make($this->toArray(), [
			'first_name' => ['required', 'string', 'max:255'],
			'last_name' => ['required', 'string', 'max:255'],
			'email' => ['required', 'string', 'email', 'max:255'],
			'phone' => ['required', 'min:10', 'max:10'],
			'city' => ['required', 'string', 'min:1'],
			'gender' => ['required', 'string'],
			'dob' => 'required|date|before:-18 years',
		], $messages);

		if ($validator->fails()) {
			return false;
		}

		return true;
	}

	public function hasCompleteStoreProfile()
	{
		if (!$this->store) {
			return false;
		};

		if (!$this->store->address) {
			return false;
		};

		if (!$this->store->hasCompleteProfile()) {
			return false;
		}

		return true;
	}

	public function payPlanSubscription($card_token, $plan, $coupon = null)
	{

		if ($coupon) {

			if (!$coupon->isValid('plans')) {
				return [
					'error' => 'El cupón no es válido',
				];
			}

			// If is specific plan only
			if ($coupon->plans()->count()) {
				if (!$coupon->plans->firstWhere('id', $plan->id)) {
					return [
						'error' => 'El cupón no es válido para el plan seleccionado',
					];
				}
			}

			$discount = $coupon->getCalculatedDiscountValue($plan->price);
			$plan->price = max($plan->price - $discount, 0); // Change but dont save
		}

		$data = [
			'amount' => $plan->price,
			'description' => 'Suscripción de Plan ' . $plan->name . ' en Armario Móvil',
			'dev_reference' => $this->id . '_' . $plan->id,
			'vat' => round($plan->price - ($plan->price / 1.12), 2),
		];

		if ($plan->price > 0) {


			// dd($data);
			$paymentez = new PaymentezService();
			$payment = $paymentez->debitWithToken($this, $card_token, $data);

			// dd($payment);
			if (isset($payment['error'])) {
				$message = collect(json_decode($payment['error']));
				$message = ($message['error']->description);
				return [
					'error' => 'Error al procesar pago: ' . $message,
				];
			}

			if ($payment['transaction']->status == 'failure') {
				return [
					'error' => 'Error al procesar pago: ' . $payment['transaction']->message,
				];
			}

			if ($payment['transaction']->status == 'pending') {
				return [
					'error' => 'El pago está pendiente: ' . $payment['transaction']->message,
				];
			}

			// Content ID not present here, will be passed after plan is effectively updated in controller
			$transaction = new Transaction();
			$transaction->user_id = $this->id;
			$transaction->content_type = 'plan_subscription';
			$transaction->amount = $plan->price;
			$transaction->status = $payment['transaction']->status;
			$transaction->transaction_id = $payment['transaction']->id;
			$transaction->authorization_code = $payment['transaction']->authorization_code;
			$transaction->description = 'Pago de plan de suscripción ' . $plan->name;
			$transaction->card_token = Crypt::encryptString($card_token);
			$transaction->save();
		} else {
			$transaction = new Transaction();
			$transaction->user_id = $this->id;
			$transaction->content_type = 'plan_subscription';
			$transaction->amount = $plan->price;
			$transaction->status = 'No requiere pago';
			$transaction->transaction_id = 0;
			$transaction->authorization_code = 0;
			$transaction->description = 'Pago de plan de suscripción ' . $plan->name;
			$transaction->card_token = Crypt::encryptString($card_token);
			$transaction->save();
		}


		// Increase coupon uses after payment
		if ($coupon) {
			$coupon->uses_count++;
			$coupon->save();
		}
		return $transaction;
	}

	public function renewPlanSubscription($plan, $subscription)
	{

		$lastTransaction = Transaction::where('content_type', 'plan_subscription')->where('content_id', $subscription->id)->latest()->first();

		if (!$lastTransaction) {
			$message = 'No se pudo renovar el plan, no se ha encontrado el registro del pago usado en la última transacción';

			return [
				'error' => $message,
			];
		}

		try {
			\Log::info('Desencriptando...');
			\Log::info($lastTransaction->card_token);
			$decrypted_token = Crypt::decryptString($lastTransaction->card_token);
		} catch (DecryptException $e) {
			$message = 'No se pudo desencriptar el token de la tarjeta de la transacción anterior: ' . $e;

			return [
				'error' => $message,
			];
		}

		// Pay

		$data = [
			'amount' => $plan->price,
			'description' => 'Suscripción de Plan ' . $plan->name . ' en Armario Móvil',
			'dev_reference' => $this->id . '_' . $plan->id,
			'vat' => round($plan->price - ($plan->price / 1.12), 2),
		];

		// dd($data);
		$paymentez = new PaymentezService();
		$payment = $paymentez->debitWithToken($this, $decrypted_token, $data);

		// dd($payment);
		if (isset($payment['error'])) {
			$message = collect(json_decode($payment['error']));
			$message = ($message['error']->description);
			return [
				'error' => 'Error al procesar pago: ' . $message,
			];
		}

		if ($payment['transaction']->status == 'failure') {
			return [
				'error' => 'Error al procesar pago: ' . $payment['transaction']->message,
			];
		}

		if ($payment['transaction']->status == 'pending') {
			return [
				'error' => 'El pago está pendiente: ' . $payment['transaction']->message,
			];
		}

		// Renew

		$subscription->renew();

		$address = $this->addresses()->where('is_billing', true)->latest()->first() ?? null; // ! Newest user billing address or NULL for Consumidor final

		$transaction = new Transaction();
		$transaction->user_id = $this->id;
		$transaction->content_type = 'plan_subscription';
		$transaction->content_id = $subscription->id;
		$transaction->amount = $plan->price;
		$transaction->status = $payment['transaction']->status;
		$transaction->transaction_id = $payment['transaction']->id;
		$transaction->authorization_code = $payment['transaction']->authorization_code;
		$transaction->description = 'Renovación de plan de suscripción ' . $plan->name;
		$transaction->address_id = $address ? $address->id : null;
		$transaction->card_token = $lastTransaction->card_token;
		$transaction->save();

		// Billing

		$factura = $this->generateBill($address, $transaction);
		if (isset($factura['error'])) {
			alert()->error('Error al generar factura: ' . $factura['error']);
			return back();
		}

		$transaction->billing_document_id = $factura;
		$transaction->save();

		return true;
	}






	public function generateBill($billingAddress = null, Transaction $transaction)
	{

		Log::info('PERSEO: Inicializando... ');
		$perseo = new PerseoService();

		Log::info('PERSEO: Credenciales API correctas');

		if ($billingAddress != null) {
			$perseoCliente = $perseo->getClient($billingAddress->document_number);
			if (isset($perseoCliente['error'])) {
				$perseoCliente = $perseo->createClient($billingAddress);
				Log::error('PERSEO: No se pudo encontrar cliente, intentanto crear...'  . json_encode($perseoCliente));
				// dd($perseoCliente);
				if (isset($perseoCliente['error'])) {
					$message = $perseoCliente['error'];
					// dd($message);
					if (is_int($message) && $message == 0) {
						$message = 'No se pudo crear el cliente';
					}

					Log::error('PERSEO: No se pudo crear cliente: ' . json_encode($perseoCliente));
					return [
						'error' => $message,
					];
					// dd($perseoClienteNew);
				}
			}
			Log::info('PERSEO: Cliente obtenido: ' . $perseoCliente);
		} else {
			Log::info('PERSEO: No hay nro de documento, guardar como consumidor final');
			$perseoCliente = 1;
		}



		/**
		 * Agregar productos
		 */
		$perseoProducts = [];
		Log::info('PERSEO: Obteniendo productos... ');

		$perseoProduct = $perseo->getPlanAsProduct($this->plan);

		if (isset($perseoProduct['error'])) {
			Log::error('PERSEO: Producto tipo plan no encontrado, creando...');
			$perseoProduct = $perseo->createPlanAsProduct($this->plan);
			// dd($perseoProduct);
			if (isset($perseoProduct['error'])) {
				Log::error('PERSEO: Producto tipo plan no se pudo crear... ' . json_encode($perseoProduct));
				$message = $perseoProduct['error'];
				// dd($message);
				if (is_int($message) && $message == 0) {
					$message = 'No se pudo crear el producto, error desconocido';
				}

				return [
					'error' => $message,
				];
				// dd($perseoClienteNew);
			}
			Log::info('PERSEO: Producto tipo plan creado... ' . json_encode($perseoProduct));
		}

		Log::info('PERSEO: Producto tipo plan obtenido... ' . json_encode($perseoProduct));

		$data = [
			'productosid' => $perseoProduct,
			'order_item' => [
				'quantity' => 1,
				'sum_price' => $transaction->amount,
				'sum_price_final' => $transaction->amount,
				'unit_price' => $transaction->amount,
				'unit_price_final' => $transaction->amount,
				'coupon_discount' => 0
			],
		];
		$perseoProducts[] = $data;


		Log::info('PERSEO: Productos tipo plan creados/obtenidos: ' . json_encode($perseoProducts));

		$subtotal_without_vat = $transaction->amount / 1.12;
		$perseoData = [
			'amount' => $transaction->amount,
			'subtotal' => $subtotal_without_vat,
			'vat_price' => $transaction->amount - $subtotal_without_vat,
			'clientesid' => $perseoCliente,
			'detalles' => $perseoProducts,
			'coupon_discount' => 0
		];
		\Log::info('Creando factura PERSEO...');
		\Log::info($perseoData);

		$factura = $perseo->generateBill($perseoData);

		Log::info('PERSEO: Respuesta factura plan de producto: ' . json_encode($factura));

		if (isset($factura['error'])) {
			$message = collect(json_decode($factura['error']));
			$message = ($message);

			return [
				'error' => $message,
			];
		}

		$transaction->billing_document_id = $factura;
		$transaction->save();

		Mail::to($this)->send(new UserPlanBillCreated($this, $transaction));

		return $factura;
	}




	public function getPlan()
	{
		$subscription = $this->getSubscription();

		$plan = app('rinvex.subscriptions.plan')->with('features')->find($subscription->plan_id);
		return $plan;
	}

	public function getSubscription()
	{
		$subscription = app('rinvex.subscriptions.plan_subscription')
			->where('user_type', 'App\User')
			->where('user_id', $this->id)
			->where('name->es', 'main')
			->whereNull('canceled_at')
			->whereDate('ends_at', '>=', Carbon::now()->format('Y-m-d'))
			->latest()
			->first();

		// $subscription = $this->subscription('main');
		// dd($subscription);
		if (!$subscription) {
			// dd('create new subcription');
			$plan = app('rinvex.subscriptions.plan')->where('slug', 'ropero')->first();
			$this->newSubscription('main', $plan);

			$subscription = app('rinvex.subscriptions.plan_subscription')
				->where('user_type', 'App\User')
				->where('user_id', $this->id)
				->where('name->es', 'main')
				->whereNull('canceled_at')
				->whereDate('ends_at', '>=', Carbon::now()->format('Y-m-d'))
				->latest()
				->first();

			return $subscription;
		}

		return $subscription;
	}

	public function canUpgradeToPlan($plan)
	{
		if ($plan->isFree()) {
			return false;
		}

		if ($this->getPlan() && $this->getPlan()->id == $plan->id) {
			return false;
		}

		// * Don't allow stores with no RUC document_number in its address
		if ($plan->slug == 'armario' && !$this->store->hasRuc()) {
			return false;
		}

		// if ($this->getPlan() && $this->getPlan()->price >= $plan->price) {
		// 	return false;
		// }

		return true;
	}


	public function canSeeArticleCategory($category)
	{
		$userPlan = $this->getPlan();
		$canDo = false;
		switch ($category->plan->slug) {
			case 'armario':
				if ($userPlan->slug == 'armario') {
					$canDo = true;
				}
				break;

			case 'closet':
				if ($userPlan->slug == 'closet' || $userPlan->slug == 'armario') {
					$canDo = true;
				}
				break;

			default:
				$canDo = false;
				break;
		}
		return $canDo;
	}



	public function canSeeDashboard($dashboard)
	{
		$userPlan = $this->getPlan();
		$canDo = false;
		switch ($dashboard) {
			case 'sell_records':
				$canDo = true;
				break;

			case 'business_profile':
				if ($userPlan->slug == 'closet' || $userPlan->slug == 'armario') {
					$canDo = true;
				}
				break;

			case 'interactions':
				if ($userPlan->slug == 'closet' || $userPlan->slug == 'armario') {
					$canDo = true;
				}
				break;

			case 'products':
				if ($userPlan->slug == 'closet' || $userPlan->slug == 'armario') {
					$canDo = true;
				}
				break;

			case 'cities':
				if ($userPlan->slug == 'armario') {
					$canDo = true;
				}
				break;

			case 'funnel':
				if ($userPlan->slug == 'armario') {
					$canDo = true;
				}
				break;

			default:
				$canDo = false;
				break;
		}
		return $canDo;
	}


	public function getMostVisitedProducts()
	{
		$analytics_data = Analytics::performQuery(
			Period::months(6),
			"ga:uniquePageviews", // METRICS
			[
				'dimensions' => 'ga:dimension1,ga:pagePath',
				// 'metrics' => 'ga:sessions, ga:pageviews',
				'filters' => "ga:dimension1==" . $this->id,
			]
		)->getRows();

		$slugs = collect($analytics_data)->map(function ($c) {
			$url = $c[1]; // Index of dimension1(userCustomId) in response is 1
			$urlElements = (explode('/', $url));
			$slug = end($urlElements);
			return $slug;
		})->filter(function ($c) {
			return !empty($c);
		});

		$recently_viewed = Product::notOffline()->whereIn('slug', $slugs)->whereIsActive(true)->hasStock()->latest()->get()->take(12);

		return $recently_viewed;
	}

	public function scopeAgedBetween($query, $start, $end = null)
	{
		if (is_null($end)) {
			$end = $start;
		}

		$start = Carbon::now()->subYears($start)->addYear()->subDay()->format('Y-m-d');
		$end = Carbon::now()->subYears($end)->addYear()->subDay()->format('Y-m-d'); // plus 1 year minus a day
		return $query->whereDate('dob', '<=', $start)->whereDate('dob', '>=', $end);
	}


	public function scopeFollowingStore($query, UserStore $store)
	{
		return $query->has('followedStores')->whereHas('followedStores', function ($followedStores) use ($store) {
			$followedStores->where('user_stores.id', $store->id);
		});
	}


	public function routeNotificationForFcm($notification)
	{
		return $this->fcm_token;
	}

	public function sendPasswordResetNotification($token)
	{
		$this->notify(new PasswordResetRequest($this, $token));
	}


	public function canCreateProduct()
	{
		$plan = $this->getPlan();

		// dd($plan);

		if (!$plan) {
			return false;
		}

		$max_products = collect($plan->features)->firstWhere('name', 'max_products')->value;


		if ($this->store->products->count() >= $max_products) {
			return false;
		}

		return true;
	}
}
