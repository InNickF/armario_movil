<?php

namespace App\Models;

use App\Mail\BillCreated;
use App\Mail\OrderCreated;
use App\Notifications\ClientProductBought;
use App\Notifications\ProductBought;
use App\Services\GlovoService;
use App\Services\PerseoService;
use App\Services\UrbanoService;
use Carbon\Carbon;
use Eloquent as Model;
use function GuzzleHttp\json_encode;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class Order extends Model implements HasMedia
{
    use HasMediaTrait;

    public $table = 'orders';

    public $guarded = [
        'id',
    ];

    public $with = [
        'status',
    ];

    public $appends = [
        'can_ask_refund',
        'can_refund',
        'bill_documents',
    ];

    /**
     * Validation rules.
     *
     * @var array
     */
    public static $rules = [
        // 'total_price' => 'required',
        // 'subtotal' => 'required',
        // 'billing_address_id' => 'required',// * Not required as it will be added after order create & pay
        'shipping_address_id' => 'required',
        'status_id' => 'sometimes|exists:order_statuses,id',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'status_id' => 'integer',
        'user_id' => 'integer',
        'shipping_address_id' => 'string',
        'billing_address_id' => 'string',
        'total_price' => 'float',
        'subtotal' => 'float',
        'notes' => 'string',
        'coupon_id' => 'integer',
        'shipping_data' => 'array',
        'conditions' => 'array',
        'local_shipping_price' => 'float',
        'national_shipping_price' => 'float',
        'total_shipping_price' => 'float',
        'billing_document_id' => 'string',
        'vat_price' => 'float',
        'is_bill_uploaded' => 'boolean',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function coupon()
    {
        return $this->belongsTo(\App\Models\Coupon::class);
    }

    public function status()
    {
        return $this->belongsTo(\App\Models\OrderStatus::class, 'status_id');
    }

    public function shipping_address()
    {
        return $this->belongsTo(\App\Models\Address::class, 'shipping_address_id');
    }

    public function billing_address()
    {
        return $this->belongsTo(\App\Models\Address::class, 'billing_address_id');
    }

    public function payment_method()
    {
        return $this->belongsTo(\App\Models\PaymentMethod::class);
    }

    public function product_variants()
    {
        return $this->belongsToMany(\App\Models\ProductVariant::class, 'order_items')->withPivot('quantity', 'sum_price_final', 'sum_price_subtotal');
    }

    public function items()
    {
        return $this->hasMany(\App\Models\OrderItem::class);
    }

    public function user()
    {
        return $this->belongsTo(\App\User::class);
    }

    public function shipping_orders()
    {
        return $this->hasMany(ShippingOrder::class);
    }

    public function getShippingType()
    {
        if ($this->local_shipping_price > 0) {
            return 'local';
        }

        return 'national';
        // // Si un producto es nacional cobrar como envio NACIONAL
        // foreach ($this->items as $item) {
        // 	if ($item->shipping_order && $item->shipping_order->provider == 'Urbano') {
        // 		return 'national';
        // 	}
        // }

        // return 'local';
    }

    public function getLocalItems()
    {
        return $this->items->filter(function ($item) {
            return 'Glovo' == $item->shipping_provider;
        });
    }

    public function getNationalItems()
    {
        return $this->items->filter(function ($item) {
            return 'Urbano' == $item->shipping_provider;
        });
    }

    public function generateLocalShippingOrder()
    {
        $result = [];

        $pendingItems = $this->getLocalItems()->whereIn('status', ['Pendiente']);

        // if no items to process return without error
        if (!$pendingItems->count()) {
            return;
        }

        // Only pending and with store open now
        $queueItems = $pendingItems->filter(function ($i) {
            $store = $i->product_variant->product->store;

            // If is always open include
            if ($store->is_always_open) {
                return true;
            }

            // If store has no open hour range leave out
            if (!$store->getOpenHoursRanges()) {
                return false;
            }

            // If has ranges check if its open this moment
            return $store->getOpenHoursRanges()->isOpenAt(Carbon::now());
        });

        // if no items to process return without error
        if (!$queueItems->count()) {
            return [
                'error' => 'Las tiendas de este pedido están cerradas en este momento, se despachará el pedido en el siguiente horario disponible',
            ];
        }

        $queueStores = $queueItems->map(function ($item) {
            return $item->product_variant->product->store;
        });

        $addresses = [];

        foreach ($queueStores->take(8) as $store) { // *Limit to 8 stores because its Glovo limit
            $pickup_point =
                [
                    'type' => 'PICKUP',
                    'lat' => $store->address->latitude,
                    'lon' => $store->address->longitude,
                    'label' => $store->address->full_address,
                    'details' => $store->address->reference ?? '',
                    'contactPhone' => $store->address->phone ?? '',
                    'contactPerson' => $store->user->full_name,
                    'instructions' => sprintf('Tienda: %s, nombre vendedor: %s, número vendedor: %s, dirección tienda: %s', $store->name, $store->user->full_name, $store->user->phone, $store->address->full_address), // TODO: TEST
                ];
            $addresses[] = $pickup_point;
        }

        $addresses[] = [
            'type' => 'DELIVERY',
            'lat' => $this->shipping_address->latitude,
            'lon' => $this->shipping_address->longitude,
            'label' => $this->shipping_address->full_address,
            'details' => $this->shipping_address->reference ?? '',
            'contactPhone' => $this->user->phone ?? '',
            'contactPerson' => $this->user->full_name,
            'instructions' => sprintf('Nombre cliente: %s, teléfono cliente: %s, dirección cliente: %s', $this->user->full_name, $this->user->phone, $this->shipping_address->full_address), // TODO: TEST
        ];

        $data = [
            'reference' => [
                'id' => (string) $this->id,
            ],
            'description' => 'Envío de productos comprados en armariomovil.com',
            'addresses' => $addresses,
        ];

        \Log::info('Creating GLOVO order');
        $glovo = new GlovoService();
        $glovo_order = $glovo->createOrder($data);

        \Log::info($glovo_order);

        if (is_array($glovo_order) && isset($glovo_order['error'])) {
            $message = $glovo_order['error'];

            return [
                'error' => 'Error al generar orden de envío GLOVO: '.$message,
            ];
        }
        // Create a Shipping Order
        $shipping_order = $this->shipping_orders()->create([
            'tracking_number' => $glovo_order['id'],
            'price' => $queueItems->sum('sum_price_final') ?? 0,
            'code' => $glovo_order['code'],
            'provider' => 'Glovo',
            'status' => $glovo_order['state'],
            // 'tracking_history_json' => json_encode($glovo_order->status_orders),
            'provider_order_json' => $glovo_order,
        ]);

        // Assign SAME tracking code to sent local order items
        foreach ($queueItems as $item) {
            $item->shipping_order_id = $shipping_order->id;
            $item->status = 'En camino';
            $item->save();
        }

        foreach ($queueStores as $store) {
            try {
                $shipping_order->sendOrderSoldEmail($store);
            } catch (\Throwable $th) {
                \Log::error('Error al enviar MAIL ENTREGA GLOVO');
                \Log::error($th);
            }
        }

        if ('shipping' == $this->status->slug) {
            // Mail to user who bought
            Mail::to($this->user)->send(new OrderCreated($this));
        }

        $result[] = 'Orden de envio creada #'.$shipping_order->tracking_number;

        return $result;
    }

    public function generateNationalShippingOrder()
    {
        $result = [];
        $items = $this->items;

        $pendingItems = $this->getNationalItems()->whereIn('status', ['Pendiente']);

        // if no items to process return without error
        if (!$pendingItems->count()) {
            return;
        }

        // Only pending and with store open now
        $queueItems = $pendingItems->filter(function ($i) {
            $store = $i->product_variant->product->store;

            // If is always open include
            if ($store->is_always_open) {
                return true;
            }

            // If store has no open hour range leave out
            if (!$store->getOpenHoursRanges()) {
                return false;
            }

            // If has ranges check if its open this moment
            return $store->getOpenHoursRanges()->isOpenAt(Carbon::now());
        });

        // if no items to process return without error
        if (!$queueItems->count()) {
            return [
                'error' => 'Las tiendas de este pedido están cerradas en este momento, se despachará el pedido en el siguiente horario disponible',
            ];
        }

        $itemsByStore = $this->groupItemsByStore($queueItems);

        foreach ($itemsByStore as $storeId => $items) {
            $params = [
                // Datos Documento del cliente
                'cod_rastreo' => (string) ('O'.$this->id.'_T'.$storeId), // Compose key order_id + store_id
                // 'cod_barra' => '22222222222',
                'fech_emi_vent' => Carbon::now()->format('d/m/Y'), // optional
                // 'nro_o_compra' => '33333333333', // optional
                // 'nro_guia_trans' => '0000001', // optional
                'nro_factura' => $this->billing_document_id, // optional

                // Datos del cliente
                'cod_cliente' => $this->billing_address->document_number ?? '9999999999', // If no data assume CONSUMIDOR FINAL, or user has selected a shipping address only in checkout
                'nom_cliente' => $this->user->full_name,
                // 'nom_empresa' => '99999991', // optional
                'nro_telf' => $this->user->phone ?? '', // optional
                'nro_telf_mobil' => $this->user->phone ?? '', // optional
                'correo_elec' => $this->user->email ?? '', // optional

                // Datos de dirección
                'dir_entrega' => $this->shipping_address->street.', '.$this->shipping_address->property_number.', '.$this->shipping_address->secondary_street,
                // 'nro_via' => 1111,
                // 'nro_int' => '1111',
                // 'nom_urb' => 'Test', // optional
                'ubi_direc' => $this->shipping_address->ubigeo->ubigeo,
                'ref_direc' => $this->shipping_address->reference ?? '', // optional
                // 'id_direc' => 0, // optional

                // Datos de entrega
                // 'fech_pro' => Carbon::now()->format('m/d/Y'), // optional
                // 'arco_hor' => 'PM', // optional
                // 'fech_venc' => Carbon::now()->format('m/d/Y'), // optional

                // DESPACHOS
                'peso_total' => '1.5', // optional
                'pieza_total' => (string) collect($items)->sum('quantity'),
                'venta_seller' => 'SI', // optional
                'sell_codigo' => (string) $storeId,
                'sell_nombre' => $items[0]->product_variant->product->store->name,
                'sell_direcc' => $items[0]->product_variant->product->store->address->street.', '.$items[0]->product_variant->product->store->address->secondary_street.', '.$items[0]->product_variant->product->store->address->reference,
                'sell_ubigeo' => $items[0]->product_variant->product->store->address->ubigeo->ubigeo,

                'productos' => [],

                // AUTORIZADOS SON OPCIONALES

                // COBRANZA NO APLICA

                // RETORNO  NO APLICA
            ];

            foreach ($queueItems as $key => $item) {
                $params['productos'][] =
                    [
                        'cod_sku' => $item->product_variant->product->id.'_'.$item->product_variant->color.'_'.$item->product_variant->size,
                        'descr_sku' => $item->product_variant->product->name,
                        //  'modelo_sku' => 123,
                        'cantidad_sku' => (string) $item->quantity,
                    ];
            }

            Log::info('URBANO DATA:');
            Log::info($params);

            $urbano = new UrbanoService();
            $shipping_order = $urbano->createOrder($params);

            if (isset($shipping_order['error'])) {
                $message = $shipping_order['error'];
                $message = 'Error al generar orden de envío nacional: '.$message;

                return [
                    'error' => $message,
                ];
            }

            // Get full order details
            // $urbano_order = $urbano->track($shipping_order['guia']);
            // if (is_array($urbano_order) && isset($urbano_order['error'])) {
            // 	$message = $urbano_order['error'];
            // 	return [
            // 		'error' => 'Error al obtener datos de la orden de envío a nivel nacional: ' . $message
            // 	];
            // }

            // create related from a full order object
            $shipping_order = $this->shipping_orders()->create([
                'tracking_number' => $shipping_order['guia'],
                'price' => $queueItems->sum('sum_price_final') ?? 0,
                'provider' => 'Urbano',
                'store_id' => $storeId,
                'code' => $shipping_order['guia'],
                'status' => 'Nuevo',
                // 'tracking_history_json' => json_encode($urbano_order->movimientos),
                // 'provider_order_json' => json_encode($urbano_order),
            ]);

            foreach ($queueItems as $key => $item) {
                // $item->tracking_number = $shipping_order['guia']; // ! Column removed
                // $item->shipping_service_response = json_encode($shipping_order); // ! Column removed
                $item->shipping_order_id = $shipping_order->id;
                $item->status = 'En camino';
                $item->save();
            }

            $result[] = 'Orden de envío creada #'.$shipping_order->tracking_number;

            try {
                $shipping_order->sendOrderSoldEmail();
            } catch (\Throwable $th) {
                \Log::error('Error al enviar GUIA ELECTRONICA URBANO');
                \Log::error($th);
            }
        }

        if ('shipping' == $this->status->slug) {
            // Mail to user who bought
            Mail::to($this->user)->send(new OrderCreated($this));
        }

        return $result;
    }

    public function onPaid($payment)
    {
        \Log::info('Order onPaid $payment param');
        \Log::info($payment);

        $this->reduceStockFromProducts();

        $this->status_id = OrderStatus::whereSlug('billing')->first()->id;
        $this->save();

        // Si el pedido sale gratis no procesar pago y cambiar status directamente
        if ($this->total_price > 0) {
            $transaction = new Transaction();
            $transaction->user_id = auth()->user()->id;
            $transaction->content_type = 'App\Models\Order';
            $transaction->content_id = $this->id;
            $transaction->amount = $this->total_price;
            $transaction->status = $payment['transaction']['status'];
            $transaction->transaction_id = $payment['transaction']['id'];
            $transaction->authorization_code = $payment['transaction']['authorization_code'];
            $transaction->description = 'Pago de órden de productos #'.$this->id;
            $transaction->address_id = $this->billing_address_id;
            $transaction->payment_response_json = json_encode($payment);
            $transaction->save();
        }

        try {
            // Notifications
            $products = $this->items->map(function ($item) {
                return $item->product_variant->product;
            })->unique();

            $stores = [];
            \Log::info('Products for pushes');
            \Log::info($products->count());
            foreach ($products as $key => $product) {
                // Notify to Store Owner via push
                $product->store->user->notify(new ProductBought($product, auth()->user()));

                // Notify User Client via push
                auth()->user()->notify(new ClientProductBought($product));

                $stores[] = $product->store;
            }
        } catch (\Throwable $th) {
            \Log::info('No se pudo notificar a usuarios del pedido creado:');
            \Log::error($th);
        }
    }

    public function refund()
    {
        // JUST CHANGE STATUS

        $this->status_id = OrderStatus::whereSlug('refunded')->first()->id;

        foreach ($this->items as $item) {
            $item->status = 'Devuelto';
            $item->save();
        }

        $this->save();
    }

    public function canOrderProducts()
    {
        if (!$this->productsHaveStock()) {
            return false;
        }

        foreach ($this->items as $item) {
            // If more than available stock
            if ($item->quantity > $item->product_variant->quantity) {
                return false;
            }
        }

        return true;
    }

    public function productsHaveStock()
    {
        foreach ($this->items as $item) {
            if ($item->product_variant->quantity <= 0) {
                return false;
            }
        }

        return true;
    }

    public function reduceStockFromProducts()
    {
        foreach ($this->items as $item) {
            $item->product_variant->reduceStock($item->quantity);
        }
    }

    public function returnProductsToStock()
    {
        foreach ($this->items as $item) {
            $item->product_variant->returnStock($item->quantity);
        }
    }

    public function generateBill()
    {
        Log::info('PERSEO: Inicializando... ');
        $perseo = new PerseoService();

        Log::info('PERSEO: Credenciales API correctas');

        // * Case CONSUMIDOR FINAL
        if (!$this->billing_address || !$this->billing_address->document_number) {
            // consumidor final id ID 1 in Perseo API
            $perseoCliente = 1;
        } else {
            $perseoCliente = $perseo->getClient($this->billing_address->document_number);
            if (isset($perseoCliente['error'])) {
                $perseoCliente = $perseo->createClient($this->billing_address);
                Log::error('PERSEO: No se pudo encontrar cliente, intentanto crear...'.json_encode($perseoCliente));
                if (isset($perseoCliente['error'])) {
                    $message = $perseoCliente['error'];
                    if (is_int($message) && 0 == $message) {
                        $message = 'No se pudo crear el cliente';
                    }

                    Log::error('PERSEO: No se pudo crear cliente: '.json_encode($perseoCliente));

                    return [
                        'error' => $message,
                    ];
                }
            }
            Log::info('PERSEO: Cliente obtenido: '.$perseoCliente);
        }

        /**
         * Agregar productos.
         */
        $perseoProducts = [];
        Log::info('PERSEO: Obteniendo productos... ');

        foreach ($this->items as $key => $item) {
            $perseoProduct = $perseo->getProduct($item->product_variant->product);

            if (isset($perseoProduct['error'])) {
                Log::error('PERSEO: Producto no encontrado, creando...');
                $perseoProduct = $perseo->createProduct($item->product_variant->product);
                // dd($perseoProduct);
                if (isset($perseoProduct['error'])) {
                    Log::error('PERSEO: Producto no se pudo crear... '.json_encode($perseoProduct['error']));
                    $message = $perseoProduct['error'];
                    // dd($message);
                    if (is_int($message) && 0 == $message) {
                        $message = 'No se pudo crear el producto';
                    }

                    return [
                        'error' => $message,
                    ];
                }
                Log::info('PERSEO: Producto creado... '.json_encode($perseoProduct));
            }

            Log::info('PERSEO: Producto obtenido... '.json_encode($perseoProduct));

            $item = $item->toArray();
            $data = [
                'productosid' => $perseoProduct,
                'order_item' => $item,
            ];
            $perseoProducts[] = $data;
        }
        Log::info('PERSEO: Productos creados/obtenidos: '.json_encode($perseoProducts));

        // LOCAL SHIPPING AS PRODUCT IN BILL
        if ($this->local_shipping_price && $this->local_shipping_price > 0) {
            $localShippingProduct = $perseo->getShippingAsProduct('local');

            if (isset($localShippingProduct['error'])) {
                Log::error('PERSEO: Producto shipping no encontrado, creando...');
                $localShippingProduct = $perseo->createShippingAsProduct('local', $this->local_shipping_price);
                // dd($localShippingProduct);
                if (isset($localShippingProduct['error'])) {
                    Log::error('PERSEO: Producto shipping no se pudo crear... '.json_encode($localShippingProduct['error']));
                    $message = $localShippingProduct['error'];
                    // dd($message);
                    if (is_int($message) && 0 == $message) {
                        $message = 'No se pudo crear el producto shipping';
                    }

                    return [
                        'error' => $message,
                    ];
                }
                Log::info('PERSEO: Producto shipping creado... '.json_encode($localShippingProduct));
            }

            Log::info('PERSEO: Producto shipping obtenido... '.json_encode($localShippingProduct));

            $data = [
                'productosid' => $localShippingProduct,
                'order_item' => [
                    'quantity' => 1,
                    'sum_price' => $this->local_shipping_price,
                    'sum_price_final' => $this->local_shipping_price,
                    'unit_price_final' => $this->local_shipping_price,
                    'coupon_discount' => 0,
                ],
            ];
            $perseoProducts[] = $data;
        }

        // NATIONAL SHIPPING AS PRODUCT IN BILL
        if ($this->national_shipping_price && $this->national_shipping_price > 0) {
            $nationalShippingProduct = $perseo->getShippingAsProduct('national');

            if (isset($nationalShippingProduct['error'])) {
                Log::error('PERSEO: Producto shipping no encontrado, creando...');
                $nationalShippingProduct = $perseo->createShippingAsProduct('national', $this->national_shipping_price);
                // dd($nationalShippingProduct);
                if (isset($nationalShippingProduct['error'])) {
                    Log::error('PERSEO: Producto shipping no se pudo crear... '.json_encode($nationalShippingProduct['error']));
                    $message = $nationalShippingProduct['error'];
                    // dd($message);
                    if (is_int($message) && 0 == $message) {
                        $message = 'No se pudo crear el producto shipping';
                    }

                    return [
                        'error' => $message,
                    ];
                }
                Log::info('PERSEO: Producto shipping creado... '.json_encode($nationalShippingProduct));
            }

            Log::info('PERSEO: Producto shipping obtenido... '.json_encode($nationalShippingProduct));

            $data = [
                'productosid' => $nationalShippingProduct,
                'order_item' => [
                    'quantity' => 1,
                    'sum_price' => $this->national_shipping_price,
                    'sum_price_final' => $this->national_shipping_price,
                    'unit_price_final' => $this->national_shipping_price,
                    'coupon_discount' => 0,
                ],
            ];
            $perseoProducts[] = $data;
        }

        $perseoData = [
            'amount' => $this->total_price,
            'subtotal' => $this->subtotal + $this->total_shipping_price,
            'vat_price' => $this->vat_price,
            'clientesid' => $perseoCliente,
            'detalles' => $perseoProducts,
            'coupon_discount' => $this->coupon_discount,
        ];

        \Log::info('Creando factura PERSEO...');
        \Log::info($perseoData);

        $factura = $perseo->generateBill($perseoData);

        Log::info('PERSEO: Respuesta factura: '.json_encode($factura));

        if (isset($factura['error'])) {
            $message = collect(json_decode($factura['error']));
            $message = ($message);

            return [
                'error' => $message,
            ];
        }

        $this->billing_document_id = $factura;
        $this->save();

        // ! Authorize PERSEO bill (triggers PERSEO email with attached bill)
        // try {
        // 	$authorized = $perseo->authorizeBill($factura);
        // 	if (is_array($authorized) && isset($authorized['error'])) {
        // 		$message = collect($authorized['error']);
        // 		\Log::error('Error al autorizar la factura');
        // 		\Log::error($message);
        // 	} else {
        // 		\Log::info('Factura PERSEO autorizada');
        // 		\Log::info(json_encode($authorized));
        // 	}
        // } catch (\Throwable $th) {
        // 	\Log::error('Error al autorizar la factura');
        // 	\Log::error($th);
        // }

        Mail::to($this->user)->send(new BillCreated($this));

        // Save factura ID in transaction as well
        $transaction = Transaction::where('is_refund', false)->where('content_type', 'App\Models\Order')->where('content_id', $this->id)->first() ?? Transaction::create(['is_refund' => false, 'content_type' => 'App\Models\Order', 'content_id' => $this->id]);
        $transaction->billing_document_id = $factura;
        $transaction->save();

        return $factura;
    }

    public function getTotalShippingVat()
    {
        return ($this->total_shipping_price * config('armario.taxes.iva')) / 100;
    }

    // public function transactions()
    // {
    //     return $this->hasMany(\App\Models\Transaction::class);
    // }

    public function groupItemsByStore($items = null)
    {
        $itemsByStore = [];

        $items = $items ?? $this->items;

        foreach ($items as $key => $item) {
            if (!array_key_exists($item->product_variant->product->store->id, $itemsByStore)) {
                $itemsByStore[$item->product_variant->product->store->id] = [];
            }

            $itemsByStore[$item->product_variant->product->store->id][] = $item;
        }

        return $itemsByStore;
    }

    public function getItemsByStore($storeId = null)
    {
        $items = $this->items()->whereHas('product_variant.product', function ($p) use ($storeId) {
            $p->where('store_id', $storeId);
        })->get();

        return $items;
    }

    public function saveBillDocument($path, $storeId = null)
    {
        $this->addMedia(public_path('storage/'.$path))
            ->withCustomProperties(['isBill' => true, 'storeId' => $storeId])
            ->toMediaCollection('orders')
        ;
    }

    public function all_media()
    {
        return $this->morphMany('Spatie\MediaLibrary\Models\Media', 'model');
    }

    public function getAllMedia()
    {
        return $this->all_media;
    }

    public function getBillDocuments($storeId = null)
    {
        $images = $this->getAllMedia();

        if (!$images || empty($images)) {
            return [];
        }

        $bills = [];
        foreach ($images as $key => $image) {
            if ($image->hasCustomProperty('isBill')) {
                if ($storeId) {
                    if ($image->hasCustomProperty('storeId') && $image->getCustomProperty('storeId') == $storeId) {
                        $bills[] = $image;
                    }
                } else {
                    $bills[] = [
                        'created_at' => $image->created_at->format('Y/m/d h:i:s'),
                        'path' => $image->getFullUrl(),
                    ];
                }
                // $imagesNotMain[] = $image->getFullUrl();
            }
        }

        return $bills;
    }

    public function getBillDocumentsAttribute()
    {
        return $this->getBillDocuments();
    }

    public function canRefund()
    {
        $transaction = Transaction::where('is_refund', false)
            ->where('status', '!=', 'refunded')
            ->where('content_type', 'App\Models\Order')
            ->where('content_id', $this->id)
            ->first()
        ;

        if (!$transaction || !$transaction->transaction_id) {
            return false;
        }

        return 'refunded' != $this->status->slug && $this->total_price > 0;
    }

    public function getCanRefundAttribute()
    {
        return $this->canRefund();
    }

    public function canAskRefund()
    {
        // Only if created less than 24 hours ago
        if ($this->created_at < Carbon::now()->subHours(24)) {
            return false;
        }

        return 'refund' != $this->status->slug && 'refunded' != $this->status->slug && 'pending' != $this->status->slug && $this->total_price > 0;
    }

    public function getCanAskRefundAttribute()
    {
        return $this->canAskRefund();
    }

    public function scopePendingDelivery($query)
    {
        return $query->whereHas('status', function ($status) {
            $status->where('slug', 'shipping')->orWhere('slug', 'delivery');
        })->whereHas('items', function ($item) {
            $item->where('status', 'Pendiente');
        });
    }

    public function scopeNotCompleted($query)
    {
        return $query->whereHas('status', function ($status) {
            $status->where('slug', '!=', 'completed');
        });
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($order) {
            $order->uuid = (string) Str::uuid();
        });
    }

    // public function getDiscount()
    // {
    // 	return $this->items->sum('coupon_discount');
    // }
}