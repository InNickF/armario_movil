<?php

namespace App\Models;

use App\Mail\ProductPlanBillCreated;
use App\Services\PerseoService;
use Carbon\Carbon;
use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Overtrue\LaravelFollow\Traits\CanBeFavorited;
use Rinvex\Subscriptions\Models\Plan;
use Rinvex\Subscriptions\Traits\HasSubscriptions;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use stdClass;

class Product extends Model implements HasMedia
{
    use HasMediaTrait;
    use HasSubscriptions;
    use HasSlug;
    use CanBeFavorited;
    use SoftDeletes;

    public $table = 'products';

    public $guarded = [
        'id',
    ];

    public $with = [
        'store',
        'category',
        'subcategory',
        'subsubcategory',
        'variants',
        'favoriters',
        // 'all_media'
    ];

    /**
     * Validation rules.
     *
     * @var array
     */
    public static $rules = [
        'store_id' => 'exists:user_stores,id',
        'name' => 'required',
        'description' => 'required',
        'price' => 'required',
        'category_id' => 'required',
        // 'subcategory_id' => 'required',
        // 'subsubcategory_id' => 'required',
        'has_guarantee' => 'required',
        'features' => 'required',
        'example_size' => 'required',
        'style' => 'required',
    ];

    protected $appends = [
        'main_image',
        'main_image_thumbnail',
        'ad_type',
        'url',
        'plan',
        'is_favorited',
        'colors',
        'sizes',
        'colors_media',
        'colors_media_thumbs',
        'total_stock',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'store_id' => 'integer',
        'name' => 'string',
        'slug' => 'string',
        'description' => 'string',
        'is_active' => 'boolean',
        'has_discount' => 'boolean',
        'discounted_price' => 'float',
        'final_price' => 'float',
        'price' => 'float',
        'category_id' => 'integer',
        'subcategory_id' => 'integer',
        'subsubcategory_id' => 'integer',
        'has_guarantee' => 'boolean',
        'guarantee_time_months' => 'integer',
        'features' => 'array',
        'example_size' => 'string',
        'condition' => 'string',
        'style' => 'string',
    ];

    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('thumb')
            ->width(300)
            ->height(400)
            ->sharpen(10)
        ;

        $this->addMediaConversion('medium')
            ->width(600)
            ->sharpen(2)
        ;
    }

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug')
            ->doNotGenerateSlugsOnUpdate()
        ;
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function variants()
    {
        return $this->hasMany(\App\Models\ProductVariant::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function store()
    {
        return $this->belongsTo(\App\Models\UserStore::class, 'store_id', 'id')->withTrashed();
    }

    public function plans()
    {
        return $this->belongsToMany(Plan::class, 'plan_subscriptions', 'user_id', 'plan_id')->where('user_type', 'App\Models\Product');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    // public function categories()
    // {
    //     return $this->belongsToMany(\App\Models\Category::class, 'products_categories');
    // }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(\App\Models\Category::class, 'category_id');
    }

    public function subcategory()
    {
        return $this->belongsTo(\App\Models\Category::class, 'subcategory_id');
    }

    public function subsubcategory()
    {
        return $this->belongsTo(\App\Models\Category::class, 'subsubcategory_id');
    }

    // public function mainCategory()
    // {
    //     return $this->belongsTo(\App\Models\Category::class, 'category_id');
    // }

    public function coupons()
    {
        return $this->belongsToMany(\App\Models\Coupon::class, 'coupons_products');
    }

    public function outfits()
    {
        return $this->belongsToMany(\App\Models\Outfit::class, 'outfits_products');
    }

    public function questions()
    {
        return $this->hasMany(\App\Models\Question::class)->where('is_active', true);
    }

    public function ordered_items()
    {
        return $this->hasManyThrough(\App\Models\OrderItem::class, \App\Models\ProductVariant::class);
    }

    // public function all_media()
    // {
    //     return $this->morphMany('Spatie\MediaLibrary\Models\Media', 'model');
    // }

    public function getAllImages()
    {
        $images = $this->media;

        foreach ($images as $key => &$media) {
            if (false !== strpos($media->mime_type, 'video')) {
                unset($images[$key]);
            }
        }

        return $images;
    }

    public function getMainImageThumbnailAttribute()
    {
        return $this->getFirstMediaUrl('products', 'thumb') ?? $this->getFirstMediaUrl('products');
    }

    public function getMainImageAttribute()
    {
        return $this->getFirstMediaUrl('products', 'thumb');
    }

    public function getImagesAttribute()
    {
        $images = $this->media;

        $imagesNotMain = [];

        if ($images && $images->count()) {
            foreach ($images as $key => $image) {
                if (!$image->hasCustomProperty('isMain')) {
                    $imagesNotMain[] = $image->getFullUrl('thumb');
                }
            }
        }

        return $imagesNotMain;
    }

    public function getColorsMediaAttribute()
    {
        $result = new stdClass();
        $images = $this->media;
        if (!empty($this->colors)) {
            foreach ($this->colors as $color) {
                $result->{$color} = new stdClass();
            }
            foreach ($images as $key => $image) {
                if ($image->hasCustomProperty('color') && $image->getCustomProperty('key')) {
                    $color = $image->getCustomProperty('color');
                    $key = $image->getCustomProperty('key');

                    if (!empty($result->{$color})) {
                        // if video show original
                        if (false === strpos($image->mime_type, 'video')) {
                            $result->{$color}->{$key} = $image->getFullUrl('medium');
                        } else {
                            $result->{$color}->{$key} = $image->getFullUrl();
                        }
                    }
                }
            }
        }

        return collect($result)->map(function ($images) {
            return collect($images)->sortKeys();
        });
    }

    public function getColorsMediaThumbsAttribute()
    {
        $result = new stdClass();
        $images = $this->media;
        if (!empty($this->colors)) {
            foreach ($this->colors as $color) {
                $result->{$color} = new stdClass();
            }
            foreach ($images as $key => $image) {
                if ($image->hasCustomProperty('color') && $image->getCustomProperty('key')) {
                    $color = $image->getCustomProperty('color');
                    $key = $image->getCustomProperty('key');

                    if (!empty($result->{$color})) {
                        $result->{$color}->{$key} = $image->getFullUrl('thumb');
                    }
                }
            }
        }

        return $result;
    }

    public function saveMainImage($path)
    {
        $this->addMedia(public_path('storage/'.$path))
            ->withCustomProperties(['isMain' => true])
            ->toMediaCollection('products')
        ;
    }

    public function saveImage($path, $order)
    {
        $this->addMedia(public_path('storage/'.$path))
            ->withCustomProperties(['order' => $order])
            ->toMediaCollection('products')
        ;
    }

    public function saveColorImage($key, $color, $path)
    {
        $this->addMedia(public_path('storage/'.$path))
            ->withCustomProperties(['color' => $color, 'key' => $key])
            ->toMediaCollection('products')
        ;
    }

    public function getColorVariantImage($color)
    {
        $mediaByColor = collect($this->colors_media);
        $colorMedia = $mediaByColor[$color];

        return $colorMedia['image_1'] ?? null;
    }

    public function validateCoupon(Coupon $coupon)
    {
        if (!$coupon->isValid()) {
            return false;
        }
        if ('products' != $coupon->target) {
            return false;
        }

        if ($coupon->products->count()) {
            if (!$coupon->products->firstWhere('id', $this->id)) {
                return false;
            }
        }

        if ($coupon->categories->count()) {
            if (!$coupon->categories->firstWhere('id', $this->category_id)) {
                return false;
            }
        }

        if ($coupon->stores->count()) {
            if (!$coupon->stores->firstWhere('id', $this->store->id)) {
                return false;
            }
        }

        return true;
    }

    public function scopeCategoryWithId($query, $value)
    {
        return $query->where(function ($q) use ($value) {
            $q->orWhere('category_id', $value)->orWhere('subcategory_id', $value)->orWhere('subsubcategory_id', $value);
        });
    }

    public function scopeFollowedCategories($query)
    {
        $user = auth('api')->check() ? auth('api')->user() : (auth()->user() ?? null);
        if (!$user) {
            return $query;
        }

        return $query->whereIn('category_id', $user->followings(Category::class)->pluck('id'));
    }

    public function scopeSearch($query, $value)
    {
        return $query->where('name', 'like', '%'.$value.'%')
            ->orWhere('description', 'like', '%'.$value.'%')
            ->orWhere('category_id', 'like', $value)
        ;
    }

    public function scopeSize($query, $value)
    {
        return $query->whereHas('variants', function ($vars) use ($value) {
            $vars->where('size', 'like', '%'.$value.'%');
        });
    }

    public function scopeColor($query, $value)
    {
        return $query->whereHas('variants', function ($vars) use ($value) {
            $vars->where('color', 'like', '%'.$value.'%');
        });
    }

    public function scopePrice($query, $value)
    {
        $range = explode('_', $value);
        $query->where('final_price', '>=', $range[0]);

        if ($range[1] > 0) { // 0 = infinite
            // var_dump($range);
            $query->where('final_price', '<=', $range[1]);
        }

        return $query;
    }

    public function scopeStoreHasAddress($query)
    {
        return $query->whereHas('store', function ($s) {
            return isset($s->address) && !empty($s->address);
        });
    }

    public function scopeNotOffline($query)
    {
        return $query->whereHas('store', function ($store) {
            return $store->notOffline();
        });
    }

    public function scopeCity($query, $value)
    {
        return $query->whereHas('store', function ($store) use ($value) {
            return $store->whereHas('address', function ($address) use ($value) {
                return $address->whereHas('ubigeo', function ($ubigeo) use ($value) {
                    return $ubigeo->where('city', $value);
                });
            });
        });
    }

    public function scopePlan($query, $planSlug)
    {
        // * Check if plan is active
        return $query->whereHas('subscriptions', function ($subs) {
            return $subs->whereNull('canceled_at');
            // ->whereDate('ends_at', '>=', Carbon::now()->format('Y-m-d')); // FIXME: Uncomment for filtering expired
        })->whereHas('plans', function ($plans) use ($planSlug) {
            return $plans->where('plans.slug', $planSlug);
        });
    }

    public function scopePlanSecondary($query, $planSlug)
    {
        // * Check if plan is active
        return $query->whereHas('subscriptions', function ($subs) {
            return $subs->whereNull('canceled_at');
            // ->whereDate('ends_at', '>=', Carbon::now()->format('Y-m-d'));  // FIXME: Uncomment for filtering expired
        })->whereHas('plans', function ($plans) use ($planSlug) {
            return $plans->orWhere('plans.slug', $planSlug);
        });
    }

    public function scopeStorePlan($query, $planSlug)
    {
        return $query->whereHas('store.user.subscriptions', function ($subs) {
            return $subs->whereNull('canceled_at')
                ->whereDate('ends_at', '>=', Carbon::now()->format('Y-m-d'))
            ;
        })->whereHas('store.user.plans', function ($plans) use ($planSlug) {
            return $plans->where('plans.slug', $planSlug);
        });
    }

    public function isNew()
    {
        return $this->created_at > Carbon::now()->subDays(15);
    }

    public function getSellsCount()
    {
        return $this->ordered_items()->with('order')->whereHas('order', function ($order) {
            return $order->with(['status', 'items'])->whereHas('status', function ($status) {
                return $status->where('slug', '!=', 'pending')->orWhere('slug', '!=', 'cancelled')->orWhere('slug', '!=', 'refunded');
            });
        })->count();
    }

    public function getAdTypeAttribute()
    {
        return $this->getAdType();
    }

    public function onPlanPaid($payment, Plan $plan)
    {
        \Log::info('Changing product plan to '.$plan->name);
        if ($this->getSubscription()) {
            $this->getSubscription()->changePlan($plan);
        } else {
            $this->newSubscription('main', $plan);
        }
        \Log::info($this->getSubscription());

        $transaction = new Transaction();
        $transaction->user_id = auth()->user()->id;
        $transaction->content_type = 'App\Models\Product';
        $transaction->content_id = $this->id;
        $transaction->amount = $plan->price;
        $transaction->status = $payment['transaction']['status'];
        $transaction->transaction_id = $payment['transaction']['id'];
        $transaction->authorization_code = $payment['transaction']['authorization_code'];
        $transaction->description = 'Pago de plan de anuncios '.$plan->name.' para producto '.$this->name;
        $transaction->save();
    }

    public function generateBill($billingAddress = null, Transaction $transaction)
    {
        Log::info('PERSEO: Inicializando... ');
        $perseo = new PerseoService();

        Log::info('PERSEO: Credenciales API correctas');

        if (null != $billingAddress) {
            $perseoCliente = $perseo->getClient($billingAddress->document_number);
            if (isset($perseoCliente['error'])) {
                $perseoCliente = $perseo->createClient($billingAddress);
                Log::error('PERSEO: No se pudo encontrar cliente, intentanto crear...'.json_encode($perseoCliente));
                // dd($perseoCliente);
                if (isset($perseoCliente['error'])) {
                    $message = $perseoCliente['error'];
                    // dd($message);
                    if (is_int($message) && 0 == $message) {
                        $message = 'No se pudo crear el cliente';
                    }

                    Log::error('PERSEO: No se pudo crear cliente: '.json_encode($perseoCliente));

                    return [
                        'error' => $message,
                    ];
                    // dd($perseoClienteNew);
                }
            }

            Log::info('PERSEO: Cliente obtenido: '.$perseoCliente);
        } else {
            Log::info('PERSEO: No hay nro de documento, guardado como consumidor final');
            $perseoCliente = 1;
        }

        /**
         * Agregar productos.
         */
        $perseoProducts = [];
        Log::info('PERSEO: Obteniendo productos... ');

        $perseoProduct = $perseo->getPlanAsProduct($this->plan);

        if (isset($perseoProduct['error'])) {
            Log::error('PERSEO: Producto tipo plan no encontrado, creando...');
            $perseoProduct = $perseo->createPlanAsProduct($this->plan);
            // dd($perseoProduct);
            if (isset($perseoProduct['error'])) {
                Log::error('PERSEO: Producto tipo plan no se pudo crear... '.json_encode($perseoProduct));
                $message = $perseoProduct['error'];
                // dd($message);
                if (is_int($message) && 0 == $message) {
                    $message = 'No se pudo crear el producto';
                }

                return [
                    'error' => $message,
                ];
                // dd($perseoClienteNew);
            }
            Log::info('PERSEO: Producto tipo plan creado... '.json_encode($perseoProduct));
        }

        Log::info('PERSEO: Producto tipo plan obtenido... '.json_encode($perseoProduct));

        $data = [
            'productosid' => $perseoProduct,
            'order_item' => [
                'quantity' => 1,
                'sum_price' => $transaction->amount,
                'sum_price_final' => $transaction->amount,
                'unit_price' => $transaction->amount,
                'unit_price_final' => $transaction->amount,
                'coupon_discount' => 0,
            ],
        ];
        $perseoProducts[] = $data;

        Log::info('PERSEO: Productos tipo plan creados/obtenidos: '.json_encode($perseoProducts));

        $subtotal_without_vat = $transaction->amount / 1.12;
        $perseoData = [
            'amount' => $transaction->amount,
            'subtotal' => $subtotal_without_vat,
            'vat_price' => $transaction->amount - $subtotal_without_vat,
            'clientesid' => $perseoCliente,
            'detalles' => $perseoProducts,
            'coupon_discount' => 0,
        ];
        \Log::info('Creando factura PERSEO...');
        \Log::info($perseoData);

        $factura = $perseo->generateBill($perseoData);

        Log::info('PERSEO: Respuesta factura plan de producto: '.json_encode($factura));

        if (isset($factura['error'])) {
            $message = collect(json_decode($factura['error']));
            $message = ($message);

            return [
                'error' => $message,
            ];
        }

        $transaction->billing_document_id = $factura;
        $transaction->save();

        Mail::to($this->store->user)->send(new ProductPlanBillCreated($this, $transaction));

        return $factura;
    }

    public function canUpgradeToPlan($plan)
    {
        if ($plan->isFree()) {
            return false;
        }

        if ($this->getPlan() && $this->getPlan()->id == $plan->id) {
            return false;
        }

        // if ($this->getPlan() && $this->getPlan()->sort_order >= $plan->sort_order) {
        //     return false;
        // }

        return true;
    }

    public function getAdType()
    {
        $mainSubscription = $this->getPlan();

        if (!$mainSubscription) {
            return null;
        }
        // var_dump($mainSubscription);
        return $mainSubscription;
    }

    public function getPlan()
    {
        $subscription = $this->getSubscription();

        // dd($subscription);
        if (!$subscription) {
            return null;
        }

        return app('rinvex.subscriptions.plan')->with('features')->find($subscription->plan_id);
    }

    public function getPlanAttribute()
    {
        return $this->getPlan();
    }

    public function getSubscription()
    {
        return app('rinvex.subscriptions.plan_subscription')
            ->where('user_type', 'App\Models\Product')
            ->where('user_id', $this->id)
            ->where('name->es', 'main')
            ->whereNull('canceled_at')
            ->whereDate('ends_at', '>=', Carbon::now()->format('Y-m-d'))
            ->latest()
            ->first()
        ;
    }

    public function getUrlAttribute()
    {
        $storeSlug = ($this->store && $this->store->slug) ? $this->store->slug : 'sin-tienda';
        $categorySlug = $this->category_id ? $this->category->slug : 'general';
        $subcategorySlug = $this->subcategory_id ? $this->subcategory->slug : 'sin-subcategoria';
        $productSlug = $this->slug;

        return url('/productos/'.$storeSlug.'/'.$categorySlug.'/'.$subcategorySlug.'/'.$productSlug, ['']);
    }

    public function getIsFavoritedAttribute()
    {
        if (auth()->check()) {
            return $this->isFavoritedBy(auth()->user());
        }

        if (auth('api')->check()) {
            return $this->isFavoritedBy(auth('api')->user());
        }

        return false;
    }

    public function getColorsAttribute()
    {
        $colors = $this->variants->map(function ($v) {
            return $v->color;
        })->unique()->flatten();

        // $unique = array_unique($colors);
        // Log::info(count($colors));
        return $colors;
    }

    public function getSizesAttribute()
    {
        $sizes = $this->variants->map(function ($v) {
            return $v->size;
        })->unique()->flatten();

        // $unique = array_unique($sizes);
        return $sizes;
    }

    public function scopeHasStock($query)
    {
        return $query->with('variants')->whereHas('variants', function ($v) {
            $v->where('quantity', '>', 0);
        });
    }

    public function getTotalStockAttribute()
    {
        return $this->variants->sum('quantity');
    }

    // public function getReviewsAttribute() {
    //     $data = $this->ordered_items->where('reviews', '!=', null)->map(function($oi) {
    //         return $oi->reviews;
    //     });

    //     return $data;
    // }

    // Returns a query builder
    public function getReviews()
    {
        $variantsIds = $this->variants->pluck('id');
        $orderItemsIds = OrderItem::select('id')->whereIn('product_variant_id', $variantsIds)->pluck('id');

        return Review::where('reviewable_type', 'App\Models\OrderItem')->whereIn('reviewable_id', $orderItemsIds)->whereHas('user')->latest();
    }

    public function getRating()
    {
        $average = $this->ordered_items->pluck('review')->avg('rating');

        return round($average);
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($product) {
            $product->uuid = (string) Str::uuid();
        });
    }
}