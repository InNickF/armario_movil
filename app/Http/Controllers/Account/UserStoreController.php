<?php

namespace App\Http\Controllers\Account;

use App\User;
use App\Ubigeo;
use Carbon\Carbon;
use App\Helpers\JsonHelper;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Mail\PaymentRequestCreated;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Spatie\OpeningHours\OpeningHours;
use App\Mail\AdminPaymentRequestCreated;
use App\Repositories\UserStoreRepository;

class UserStoreController extends \App\Http\Controllers\Controller
{
    /** @var  UserStoreRepository */
    private $userStoreRepository;

    public function __construct(UserStoreRepository $userStoreRepo)
    {
        $this->userStoreRepository = $userStoreRepo;
    }



    public function activate()
    {
        $user = Auth::user();
        $user->store()->create([
            'user_id' => $user->id,
            // 'name' => $user->full_name,
            'is_always_open' => false,
            'opening_hours' => OpeningHours::create([
                'monday' => ['09:00-17:00'],
                'tuesday' => ['09:00-17:00'],
                'wednesday' => ['09:00-17:00'],
                'thursday' => ['09:00-17:00'],
                'friday' => ['09:00-17:00'],
            ]),
            // 'city' => $user->city,
        ]);

        alert()->success('Estamos listos para activar tú tienda y cargar tus productos');
        return redirect(url('account/plans'));
    }


    public function destroy($id)
    {
        $store = $this->userStoreRepository->findWithoutFail($id);

        if (empty($store)) {
            alert()->error('Tienda no encontrada');

            return redirect(url('account/profile'));
        }

        if ($store->user->id != auth()->user()->id) {
            abort(403);
        }

        $this->userStoreRepository->delete($id);

        alert()->success('Tienda eliminada exitosamente');

        return redirect(url('account/profile'));
    }



    public function update(Request $request)
    {
        $input = $request->all();
        $input['user_id'] = Auth::user()->id;

        $userStore = $this->userStoreRepository->findWhere(['user_id' => $input['user_id']])->first();

        if (empty($userStore)) {
            alert()->error('Perfil de tienda no encontrado');
            // $userStore = UserStore::create($input);
            return back();
        };

        if (!isset($input['address'])) {
            alert()->error('Falta la dirección');

            return back();
        }

        $user = Auth::user();
        $input['address']['is_primary'] = true;
        $input['address']['given_name'] = $user->first_name;
        $input['address']['family_name'] = $user->last_name;

        // ! Always EC as country
        $input['address']['country_code'] = 'ec';

        $ubigeo_id = Ubigeo::where('state', $input['address']['state'])
            ->where('city', $input['address']['city'])
            ->where('district', $input['address']['district'])
            ->first()->id ?? null;
        $input['address']['ubigeo_id'] = $ubigeo_id;

        // * RUC
        if ($input['address']['document_number']) {
            if (!is_numeric($input['address']['document_number'])) {
                alert()->error('El número de RUC o cédula debe contener sólo números');
                return back();
            }

            if (strlen((string) $input['address']['document_number']) != 10 && strlen((string) $input['address']['document_number']) != 13) {
                alert()->error('Los número de RUC deben contener 13 números y los de cédula 10 números, has ingresado ' . strlen((string) $input['address']['document_number']) . '.');
                return back();
            }
        }

        // dd($input);
        /** Add or update Address */
        if (!$userStore->address) {
            $userStore->address()->create($input['address']);
        } else {
            $userStore->address->update($input['address']);
        }


        $images = $userStore->getAllMedia();

        if (isset($input['logo_image'])) {
            $logoImage = JsonHelper::jsonOrEmpty($input['logo_image']);

            if (!isset($logoImage['manuallyAdded']) || !$logoImage['manuallyAdded']) {
                foreach ($images as $key => $image) {
                    if ($image->hasCustomProperty('isLogo')) {
                        $image->delete();
                    }
                }

                $userStore->saveImage($logoImage['path'], 'isLogo');
            }
        }

        // dd($input['is_offline']);
        if ($input['is_offline'] == null) {
            $input['is_offline'] = false;
        }


        if ($input['open_hours']) {
            $ranges = [];

            // dd($input['open_hours']);
            foreach ($input['open_hours'] as $key => $day) {
                if (!isset($day['open_hour']) || empty($day['open_hour']) || !isset($day['close_hour']) || empty($day['close_hour'])) {
                    continue;
                }

                if (!isset($day['is_open']) || !$day['is_open']) {
                    continue;
                }

                try {
                    $open = Carbon::parse($day['open_hour'])->format('H:i');
                    $close = Carbon::parse($day['close_hour'])->format('H:i');
                    $ranges[$key] = [$open . '-' . $close];
                } catch (\Throwable $th) {
                    continue;
                }
            }
            // dd($ranges);
            $input['opening_hours'] = $ranges;
            // Or use the following shortcut to create from ranges that possibly overlap:
            // $mergedRanges = OpeningHours::createAndMergeOverlappingRanges($ranges);
        }

        // dump($input);

        $userStore = $this->userStoreRepository->update($input, $userStore->id);

        alert()->success('Tu tienda se ha actualizado correctamente');

        return redirect(url('account/products'));
    }

    public function orders(Request $request)
    {
        $user = Auth::user();
        // $input = $request->all();

        /**
         * Get query params
         */
        $facturasFilter = $request->get('bill_uploaded', 'all');
        $statusFilter = $request->get('status', null);
        $searchFilter = $request->get('search', null);
        $startFilter =  $request->get('start') ? Carbon::parse($request->get('start'))->startOfDay()->format('Y/m/d') : null;
        $endFilter = $request->get('end') ? Carbon::parse($request->get('end'))->endOfDay()->format('Y/m/d') : null;

        // if(auth()->user()->isA('super-user')) {
        //     $orders = \App\Models\Order::all();
        // } else {
            $orders = Auth::user()->store->orders;
        // }

        if ($startFilter) {
            $orders->whereDate('created_at', '>=', $startFilter);
        }
        if ($endFilter) {
            $orders->whereDate('created_at', '<=', $endFilter);
        }

        switch ($statusFilter) {
            case 'pending':
                $orders->whereHas('status', function ($s) use ($statusFilter) {
                    $s->where('slug', '!=', 'completed');
                });
                break;

            case 'completed':
                $orders->whereHas('status', function ($s) use ($statusFilter) {
                    $s->where('slug', 'completed');
                });
                break;

            case 'refund':
                $orders->whereHas('status', function ($s) use ($statusFilter) {
                    $s->where('slug', 'refund');
                });
                break;

            default:
                break;
        }

        if ($searchFilter) {
            // dd($orders->first()->user);

            $orders = $orders->where(function ($query) use ($searchFilter) {
                $query->where('id', 'LIKE', '%' . $searchFilter . '%')
                    ->orWhereHas('items.product_variant.product', function ($p) use ($searchFilter) {
                        $p->where('name', 'LIKE', '%' . $searchFilter . '%')
                            ->orWhere('description', 'LIKE', '%' . $searchFilter . '%');
                    })->orWhereHas('shipping_address', function ($a) use ($searchFilter) {
                        $a->where('given_name', 'LIKE', '%' . $searchFilter . '%')
                            ->orWhere('family_name', 'LIKE', '%' . $searchFilter . '%');
                    })->orWhereHas('user', function ($user) use ($searchFilter) {
                        $user->where('first_name', 'LIKE', '%' . $searchFilter . '%')
                            ->orWhere('last_name', 'LIKE', '%' . $searchFilter . '%')
                            ->orWhere('email', 'LIKE', '%' . $searchFilter . '%')
                            ->orWhere('id', 'LIKE', '%' . $searchFilter . '%');
                    });
            });
        }

        switch ($facturasFilter) {
            case 'pending':
                $orders = $orders->get()->filter(function ($order) {
                    return empty($order->getBillDocuments(Auth::user()->store->id));
                });

                break;

            case 'uploaded':
                $orders = $orders->get()->filter(function ($order) {
                    return !empty($order->getBillDocuments(Auth::user()->store->id));
                });
                break;

            default:
                break;
        }


        $orders = $orders->paginate(10);

        // Dropdowns data
        $facturasList = [
            // 'all' => 'Todas las facturas',
            'pending' => 'Facturas por subir',
            'uploaded' => 'Facturas subidas',
        ];

        $statusesList = [
            // 'all' => 'Todos',
            'completed' => 'Entregadas',
            'pending' => 'En proceso',
            'refund' => 'Canceladas',
        ];

        // $statusesList = OrderStatus::all()->pluck('name', 'id');

        return view('account.user_stores.orders.index')
            ->with(compact(
                'orders',
                'facturasList',
                'facturasFilter',
                'statusesList',
                'statusFilter',
                'startFilter',
                'endFilter',
                'searchFilter',
                'user'
            ));
    }


    public function request_payment()
    {
        try {
            $admins = User::whereIs('super-user')->get();

            $caseNumber = Str::uuid();
            Mail::to($admins)->cc([setting('admin_email', 'info@armariomovil.com'), 'servicios@armariomovil.com'])->send(new AdminPaymentRequestCreated(Auth::user()->store, $caseNumber, Carbon::now()->format('Y/m/d h:i:s')));
            Mail::to(Auth::user()->email)->send(new PaymentRequestCreated(Auth::user()->store, $caseNumber, Carbon::now()->format('Y/m/d h:i:s')));

        } catch (\Throwable $th) {
            alert()->error('Ha ocurrido un error al solicitar tu cobro inmediato');
        }


        alert()->success('Se ha enviado tu requerimiento exitosamente, te contactaremos pronto con los detalles');
        return back();
    }


    public function gallery()
    {
        $store = auth()->user()->store;
        return view('account.user_stores.gallery', compact('store'));
    }

    public function updateGallery()
    {
        $input = request()->all();
        $input['user_id'] = Auth::user()->id;

        $userStore = auth()->user()->store;

        if (empty($userStore)) {
            alert()->error('Perfil de tienda no encontrado');
            // $userStore = UserStore::create($input);
            return back();
        };

        if (!isset($input['images'])) {
            alert()->error('No se han adjuntado fotos');

            return back();
        }

        $gallery_images = $userStore->getGalleryImages();


        if (isset($input['images'])) {
            $images = JsonHelper::jsonOrEmpty($input['images']);

            // * Remove images not present in request
            $existingGalleryImages = collect($gallery_images)->mapWithKeys(function ($image) {
                return [$image->getFullUrl() => $image->getFullUrl()];
            }); // ['black' => 23, ...]

            $toDelete = $existingGalleryImages->except(collect($images)->pluck('path'));

            if ($toDelete->count()) {
                foreach ($toDelete as $path => $path) {
                    foreach ($gallery_images as $key => $oldImage) {
                        if ($oldImage->getFullUrl() == $path) {
                            $oldImage->delete();
                        }
                    }
                }
            }
            // dd($images);

            // * Save only new images
            foreach ($images as $key => $image) {
                // * If is new only
                if (!isset($image['manuallyAdded']) || !$image['manuallyAdded']) {
                    if (isset($image['path'])) {
                        $userStore->saveImage($image['path'], 'isGallery');
                    }
                }
            }
        }

        return redirect(url('account/store/gallery'));
    }
}
