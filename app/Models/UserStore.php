<?php

namespace App\Models;

use Analytics;
use App\Helpers\NumberFormatHelper;
use App\User;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Eloquent as Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Validator;
use Overtrue\LaravelFollow\Traits\CanBeFollowed;
use Rinvex\Addresses\Traits\Addressable;
use Spatie\Analytics\Period;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;
use Spatie\OpeningHours\OpeningHours;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class UserStore extends Model implements HasMedia
{
    use HasMediaTrait;
    use Addressable;
    use CanBeFollowed;
    use HasSlug;
    use SoftDeletes;
    public $table = 'user_stores';

    public $fillable = [
        'name',
        'slug',
        'description',
        'user_id',
        'is_offline',
        'is_always_open',
        'opening_hours',
    ];

    public $appends = [
        // 'orders',
        'url',
        'logo_image_thumbnail',
        'today_range',
    ];

    public $with = [
        'all_media',
    ];

    /**
     * Validation rules.
     *
     * @var array
     */
    public static $rules = [
        // 'name' => ['required', 'string', 'min:5', 'max:50'],
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
        'name' => 'string',
        'slug' => 'string',
        'description' => 'string',
        'is_offline' => 'boolean',
        'is_always_open' => 'boolean',
        'opening_hours' => 'array',
        'rating' => 'integer',
    ];

    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('thumb')
            ->width(150)
            ->height(150)
            ->sharpen(10)
        ;

        $this->addMediaConversion('medium')
            ->width(400)
            ->sharpen(2)
        ;

        $this->addMediaConversion('large')
            ->width(800)
            ->sharpen(2)
        ;
    }

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug')
        ;
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'store_id');
    }

    public function user()
    {
        return $this->belongsTo(\App\User::class);
    }

    public function stories()
    {
        return $this->hasMany(Story::class, 'store_id')->latest();
    }

    public function active_stories()
    {
        return $this->hasMany(Story::class, 'store_id')->isActive()->latest();
    }

    public function latest_story()
    {
        return $this->hasOne(Story::class, 'store_id')->isActive()->latest();
    }

    public function address()
    {
        return $this->morphOne('App\Models\Address', 'addressable');
    }

    public function all_media()
    {
        return $this->morphMany('Spatie\MediaLibrary\Models\Media', 'model');
    }

    public function getLogoImageAttribute()
    {
        $images = $this->getAllMedia();
        $names = str_replace(' ', '+', $this->name);
        $default = 'https://ui-avatars.com/api/?size=128&name='.$names;

        if (!$images || empty($images)) {
            return $default;
        }

        foreach ($images as $key => $image) {
            if ($image->hasCustomProperty('isLogo')) {
                return $image->getFullUrl('medium');
            }
        }

        return $default;
    }

    public function getLogoImageThumbnailAttribute()
    {
        $images = $this->getAllMedia();
        $names = str_replace(' ', '+', $this->name);
        $default = 'https://ui-avatars.com/api/?size=128&name='.$names;

        if (!$images || empty($images)) {
            return $default;
        }

        foreach ($images as $key => $image) {
            if ($image->hasCustomProperty('isLogo')) {
                return $image->getFullUrl('thumb');
            }
        }

        return $default;
    }

    public function saveImage($path, $property)
    {
        $this->addMedia(public_path('storage/'.$path))
            ->withCustomProperties([$property => true])
            ->toMediaCollection('stores')
        ;
    }

    public function getAllMedia()
    {
        return $this->all_media;
    }

    public function getGalleryImagesAttribute()
    {
        $images = $this->getGalleryImages();
        $default = [];

        if (!$images) {
            return $default;
        }

        $images = $images->map(function ($img) {
            return $img->getFullUrl('large');
        });

        // foreach ($images as $key => $image) {
        //     if ($image->hasCustomProperty('isGallery')) {
        //         return $image->getFullUrl();
        //     }
        // }

        return $images;
    }

    public function getGalleryImages()
    {
        $images = $this->all_media;
        $default = [];

        if (!$images) {
            return $default;
        }

        $images = $images->filter(function ($img) {
            return $img->hasCustomProperty('isGallery');
        });

        return $images;
    }

    public function getSoldProducts($start = null, $end = null)
    {
        $sold_products = OrderItem::with(['review', 'product_variant'])->whereHas('product_variant', function ($product_variant) {
            $product_variant->whereHas('product', function ($product) {
                $product->where('store_id', $this->id);
            });
        })->whereHas('order', function ($order) {
            $order->with('status')->whereHas('status', function ($status) {
                $status->where('slug', 'paid')->orWhere('slug', 'billing')->orWhere('slug', 'shipping')->orWhere('slug', 'delivery')->orWhere('slug', 'completed');
            })->whereHas('items', function ($items) {
                $items->where('status', 'Entregado');
            });
        });

        if ($start) {
            $sold_products->where('created_at', '>=', $start);
        }
        if ($end) {
            $sold_products->where('created_at', '<=', $end);
        }

        // Paid orders with products from actual store
        // $orders = Order::whereHas('status', function($query) {
        //     return $query->whereSlug('paid');
        // })->whereHas('products', function($products) {
        //     return $products->where('store_id', $this->id);
        // })->paginate($limit);

        // if(!$orders) {
        //     return [];
        // }

        // $sold_products = [];

        // foreach ($orders as $key => $order) {
        //     // Each product of the order
        //     foreach($order->product_variants as $product) {
        //         if($product->store_id == $this->id) { // Add products from this store
        //             $product->pivot->order = $order;
        //             $sold_products[] = $product;
        //         }
        //     }
        // }

        return $sold_products;
    }

    public function getSoldProductsCount()
    {
        $products = $this->getSoldProducts()->get();

        $count = 0;

        // dd($products);
        foreach ($products as $key => $product) {
            $count += $product->quantity;
        }

        return $count;
    }

    public function getQuestionsCount()
    {
        $count = $this->products->reduce(function ($count, $product) {
            return $count + $product->questions->count();
        }, 0);

        return $count;
    }

    public function getOrders()
    {
        return Order::with('user')->with('product_variants')->whereHas('product_variants.product', function ($product) {
            return $product->where('store_id', $this->id);
        })->latest();
    }

    public function getOrdersAttribute()
    {
        return $this->getOrders();
    }

    public function getActiveEarning()
    {
        return round($this->getSoldProducts()->where('is_paid_earning', false)->sum('earning'), 2);
    }

    public function getTotalEarning()
    {
        return round($this->getSoldProducts()->sum('earning'), 2);
    }

    public function getOpenHoursRanges()
    {
        if ($this->is_always_open) {
            return null;
        }

        // DEFAULTS if not set
        if (is_null($this->opening_hours) || empty($this->opening_hours)) {
            return  OpeningHours::create([
                'monday' => ['09:00-17:00'],
                'tuesday' => ['09:00-17:00'],
                'wednesday' => ['09:00-17:00'],
                'thursday' => ['09:00-17:00'],
                'friday' => ['09:00-17:00'],
            ]);
        }

        return OpeningHours::createAndMergeOverlappingRanges($this->opening_hours);
    }

    public function getDayRange($day)
    {
        $range = [];

        try {
            $range = ($this->getOpenHoursRanges()->forDay($day))[0];
        } catch (\Throwable $th) {
            return $range;
        }
        if (!empty($range)) {
            $range = [
                'start' => Carbon::parse($range->start())->format('G:i'),
                'end' => Carbon::parse($range->end())->format('G:i'),
            ];
        }

        return $range;
    }

    public function getTodayRange()
    {
        if ($this->is_always_open) {
            return null;
        }

        try {
            $result = $this->getDayRange(Carbon::now()->englishDayOfWeek);
            $final = Carbon::parse($result['start'])->format('H:i').' - '.Carbon::parse($result['end'])->format('H:i');
        } catch (\Throwable $th) {
            $final = [];
        }

        return $final;
    }

    public function getTodayRangeAttribute()
    {
        return $this->getTodayRange();
    }

    public function getOrderItems($start = null, $end = null)
    {
        $sold_products = OrderItem::whereHas('product_variant', function ($product_variant) {
            $product_variant->whereHas('product', function ($product) {
                $product->where('store_id', $this->id);
            });
        });

        // dd($start);
        if ($start) {
            $sold_products->where('created_at', '>=', $start);
        }
        if ($end) {
            $sold_products->where('created_at', '<=', $end);
        }

        return $sold_products;
    }

    public function getUrlAttribute()
    {
        return url('/tiendas/'.$this->slug);
    }

    public function scopeNotOffline($query)
    {
        return $query->where('is_offline', false);
    }

    public function hasRuc()
    {
        return $this->address ? (13 == strlen($this->address->document_number) ? true : false) : false;
    }

    public function getVisitsBySubcategories($start, $end)
    {
        $allSubCategories = $this->products->map(function ($p) {
            return $p->subcategory;
        })->unique();

        $categories = new Collection();

        foreach ($allSubCategories as $key => $category) {
            $sum_total = 0;
            $products_urls_filters = '';

            foreach ($this->products()->where('subcategory_id', $category->id)->pluck('slug')->toArray() as $key => $slug) {
                if ($key > 0) {
                    $products_urls_filters .= ',';
                }
                $products_urls_filters .= 'ga:pagePath=@/'.$slug;
            }

            $products_urls_filters .= (empty($products_urls_filters) ? '' : ';').'ga:pagePath=@/'.$this->slug;

            $visits_data = Analytics::performQuery(
                Period::create($start, $end),
                'ga:uniquePageviews',
                [
                    'filters' => $products_urls_filters,
                    'dimensions' => 'ga:month, ga:year', // 0
                    'sort' => 'ga:year, ga:month',
                ]
            );

            $catName = $category->name.' ('.$category->parent->name.')';
            $categories[$catName] = collect($visits_data->getRows())->mapWithKeys(function ($row) use (&$sum_total) {
                $visits = $row[2];
                $sum_total += $visits;

                return [Carbon::createFromFormat('m', $row[0])->format('M').'/'.$row[1] => $visits];
            });

            $categories[$catName]['total'] = $sum_total;
        }

        return $categories;
    }

    public function getSalesBySubcategories($start, $end)
    {
        Carbon::setLocale('es');
        $period = CarbonPeriod::create($start, '1 month', $end);
        $categories = $this->getSoldProducts($start, $end)->get()->groupBy(function ($item) {
            return $item->product_variant->product->subcategory->name.' ('.$item->product_variant->product->category->name.')';
        })->mapWithKeys(function ($val, $categoryName) use ($period) {
            $dataByMonth = $val->groupBy(function ($val) {
                return Carbon::parse($val['created_at'])->format('M/Y');
            })->map(function ($monthData) {
                return $monthData->sum('quantity');
            });

            $dataWithDefaults = [];

            $sum_total = 0;
            foreach ($period as $dt) {
                $existing = $dataByMonth->first(function ($data, $month) use ($dt) {
                    return $month == $dt->format('M/Y');
                });
                $dataWithDefaults[$dt->format('M/Y')] = $existing ?? 0;
                $sum_total += $existing;
                // $dataByMonth->put($dt->format("M/Y"), 0);
            }
            $dataWithDefaults['total'] = $sum_total;

            return [
                $categoryName => $dataWithDefaults,
            ];
        });

        return $categories;
    }

    public function getVisitsByCities($start, $end)
    {
        // Visits
        $products_urls_filters = '';

        foreach ($this->products()->pluck('slug')->toArray() as $key => $slug) {
            if ($key > 0) {
                $products_urls_filters .= ',';
            }
            $products_urls_filters .= 'ga:pagePath=@/'.$slug;
        }

        $products_urls_filters .= (empty($products_urls_filters) ? '' : ';').'ga:pagePath=@/'.$this->slug;

        $products_urls_filters .= ';ga:country=@Ecuador';

        $visits_data = Analytics::performQuery(
            Period::create($start, $end),
            'ga:uniquePageviews',
            [
                'filters' => $products_urls_filters,
                'dimensions' => 'ga:month, ga:year, ga:city, ga:country', // 0
                'sort' => 'ga:year, ga:month',
            ]
        );

        $cities = collect($visits_data->getRows())->map(function ($row) {
            return $row[2];
        })->filter(function ($c) {
            return '(not set)' != $c;
        });

        $data = collect([]);
        foreach ($cities as $cityName) {
            $sum_total = 0;
            $data[$cityName] = collect($visits_data->getRows())->filter(function ($row) use ($cityName) {
                return $row[2] == $cityName;
            })->mapWithKeys(function ($row) use (&$sum_total) {
                $visits = $row[4];
                $sum_total += $visits;

                return [Carbon::createFromFormat('m', $row[0])->format('M').'/'.$row[1] => $visits];
            });

            $period = CarbonPeriod::create($start, '1 month', $end);

            // Assing 0 if no data for a date
            $final_city_data = collect([]);
            foreach ($period as $dt) {
                $formattedDate = $dt->format('M/Y');
                $existingData = $data[$cityName]->filter(function ($visits, $date) use ($formattedDate) {
                    return $date == $formattedDate;
                })->first();

                if ($existingData) {
                    $final_city_data[$formattedDate] = $existingData;
                } else {
                    $final_city_data[$formattedDate] = (string) 0;
                }
            }
            $data[$cityName] = $final_city_data;

            $data[$cityName]['total'] = $sum_total;
        }

        return $data;
    }

    public function getSalesByCities($start, $end)
    {
        Carbon::setLocale('es');
        $period = CarbonPeriod::create($start, '1 month', $end);
        $cities = $this->getSoldProducts($start, $end)->get()->groupBy(function ($item) {
            return ucwords(strtolower($item->order->shipping_address->city));
        })->mapWithKeys(function ($val, $cityName) use ($period) {
            $dataByMonth = $val->groupBy(function ($val) {
                return Carbon::parse($val['created_at'])->format('M/Y');
            })->map(function ($monthData) {
                return $monthData->sum('quantity');
            });

            $dataWithDefaults = [];

            $sum_total = 0;
            foreach ($period as $dt) {
                $existing = $dataByMonth->first(function ($data, $month) use ($dt) {
                    return $month == $dt->format('M/Y');
                });
                $dataWithDefaults[$dt->format('M/Y')] = $existing ?? 0;
                $sum_total += $existing;
                // $dataByMonth->put($dt->format("M/Y"), 0);
            }
            $dataWithDefaults['total'] = $sum_total;

            return [
                $cityName => $dataWithDefaults,
            ];
        });

        return $cities;
    }

    public function getCustomers()
    {
        return User::whereHas('orders', function ($orders) {
            $orders->whereHas('product_variants.product.store', function ($store) {
                $store->where('id', $this->id);
            });
        });
    }

    public function getBusinessProfileSummary($start, $end)
    {
        $followers_count = $this->followers->count();
        $order_items = $this->getSoldProducts($start, $end);
        $sold_products_count = 0;
        $total_sold = $this->getTotalEarning();
        $sold_products_count = $order_items->count() ?? 0; // One per unique product ignoring quantity

        $sold_products_average = $order_items->avg('earning');
        $published_products_count = $this->products->count();

        return compact(
            'followers_count',
            'sold_products_count',
            'sold_products_average',
            'published_products_count',
            'total_sold'
        );
    }

    public function getInteractions($start, $end)
    {
        $published_products = $this->products;

        // General Analytics Query
        $products_urls_filters = '';

        foreach ($this->products()->pluck('slug')->toArray() as $key => $slug) {
            if ($key > 0) {
                $products_urls_filters .= ',';
            }
            $products_urls_filters .= 'ga:pagePath=@/'.$slug;
        }

        $products_urls_filters .= (empty($products_urls_filters) ? '' : ';').'ga:pagePath=@/'.$this->slug;

        // dd($products_urls_filters);
        $analytics_data = Analytics::performQuery(
            Period::create($start, $end),
            'ga:avgTimeOnPage,ga:pageviews,ga:uniquePageviews',
            [
                'filters' => $products_urls_filters,
                'dimensions' => 'ga:month, ga:year',
                'sort' => 'ga:year, ga:month',
            ]
        );

        // Numero de visitas
        // dd($analytics_data->getRows());
        $visits = collect($analytics_data->getRows())->mapWithKeys(function ($c) {
            // $visits = (int) $c[4];
            $pageviews = (int) $c[4];
            // $sessions = (int) $c[5];
            $result = 0;

            try {
                $result = $pageviews;
            } catch (Exception $th) {
            }

            return [
                $c[0].'/'.$c[1] => $result,
            ];
        });

        // Paginas por visitas
        // "ga:avgSessionDuration" => "155.19196428571428"
        // "ga:uniquePageviews" => "1638"
        // "ga:visits" => "672"
        // "ga:sessions" => "672"
        // "ga:sessionDuration" => "104289.0"
        $data_pages_per_session = collect($analytics_data->getRows())->mapWithKeys(function ($c) {
            if ($c[4] <= 0) {
                $pageviewsPerSession = 0;
            } else {
                $pageviewsPerSession = (float) round($c[3] / $c[4], 2);
            }
            // $sessions = (int) $c[5];
            // $result = 0;
            // try {
            //     $result = $sessions > 0 ? floor($pageviews / $sessions) : 0;
            // } catch (Exception $th) { }
            return [
                $c[0].'/'.$c[1] => $pageviewsPerSession,
            ];
        });

        // Tiempo de visitas
        // dd($products_urls_filters);
        $avg_session_duration = date('i:s', $analytics_data->getTotalsForAllResults()['ga:avgTimeOnPage']);
        $data_avg_time = collect($analytics_data->getRows())->mapWithKeys(function ($c) {
            return [
                $c[0].'/'.$c[1] => round($c[2], 2),
            ];
        });

        return compact('visits', 'data_pages_per_session', 'avg_session_duration', 'data_avg_time');
    }

    public function getFunnelData($start, $end)
    {
        $published_products = $this->products;
        $period = CarbonPeriod::create($start, '1 month', $end);
        // General Analytics Query
        $products_urls_filters = '';

        foreach ($published_products->pluck('slug')->toArray() as $key => $slug) {
            if ($key > 0) {
                $products_urls_filters .= ',';
            }
            $products_urls_filters .= 'ga:pagePath=@/'.$slug;
        }

        $products_urls_filters .= (empty($products_urls_filters) ? '' : ';').'ga:pagePath=@/'.$this->slug;
        // dd($products_urls_filters);

        $analytics_data = Analytics::performQuery(
            Period::create($start, $end),
            'ga:totalEvents',
            [
                'filters' => $products_urls_filters,
                'dimensions' => 'ga:month,ga:year,ga:eventAction',
                'sort' => 'ga:year, ga:month',
            ]
        );

        $data = collect($analytics_data->getRows())->groupBy(function ($row) {
            return $row[2];
        })
            ->mapWithKeys(function ($c, $key) {
                $groupedByDate = $c->groupBy(function ($row) {
                    return Carbon::createFromFormat('m', $row[0])->format('M').'/'.$row[1];
                });

                $groupedByDate = $groupedByDate->map(function ($row) {
                    return $row->sum(function ($innerRow) {
                        return $innerRow[3];
                    });
                });

                return [$key => $groupedByDate];
            })
        ;

        unset($data['Compartir'], $data['Click en Ver Oferta']);  // * Shares not needed
        // * not needed

        $analytics_data_visits = Analytics::performQuery(
            Period::create($start, $end),
            'ga:pageviews',
            [
                'filters' => $products_urls_filters,
                'dimensions' => 'ga:month,ga:year',
                'sort' => 'ga:year, ga:month',
            ]
        );

        $data['Visitas'] = collect($analytics_data_visits->getRows())->groupBy(function ($row) {
            return Carbon::createFromFormat('m', $row[0])->format('M').'/'.$row[1];
        })->mapWithKeys(function ($c, $key) {
            $monthData = collect($c);

            $monthData = $monthData->sum(function ($innerRow) {
                return $innerRow[2];
            });

            return [$key => $monthData];
        });

        // Delete if all is zero
        if (collect($data['Visitas'])->average() <= 0) {
            unset($data['Visitas']);
        }

        $sales = $this->getSoldProducts()->get()->groupBy(function ($item) {
            return Carbon::parse($item['created_at'])->format('M/Y');
        })->map(function ($monthData, $date) use ($period) {
            return $monthData->sum('quantity');
        });
        $data['Ventas'] = $sales;

        // Assing defaults 0
        $data = $data->mapWithKeys(function (&$eventData, $eventName) use ($period) {
            $dataWithDefaults = [];
            $sum_total = 0;
            foreach ($period as $dt) {
                $existing = collect($eventData)->first(function ($monthTotal, $monthName) use ($dt) {
                    return $monthName == $dt->format('M/Y');
                });

                if ($existing) {
                    $dataWithDefaults[$dt->format('M/Y')] = $existing;
                    $sum_total += $existing;
                } else {
                    $dataWithDefaults[$dt->format('M/Y')] = 0;
                }
            }
            $dataWithDefaults['total'] = $sum_total;

            return [$eventName => $dataWithDefaults];
        });

        // dd($data);

        $ids = ['Visitas', 'Preguntas / Wishlist', 'Agregar al carrito', 'Ventas'];

        $sorted = collect($data)->sortBy(function ($data, $key) use ($ids) {
            return array_search($key, $ids);
        });

        return $sorted;
    }

    public function hasCompleteProfile()
    {
        if (!$this->address || !$this->address->ubigeo) {
            // dd($this->address);
            return false;
        }

        $messages = [
            'document_number.required' => 'El RUC o CC de tienda es requerido',
            'city.required' => 'La ciudad es requerida',
            'state.required' => 'La provincia es requerida',
            'district.required' => 'El distrito es requerido',
            'street.required' => 'La calle es requerida',
            'secondary_street.required' => 'La calle secundaria es requerida',
            'property_number.required' => 'El número de casa o edificio es requerido',
            // 'phone.required'  => 'El teléfono es requerido',
            // 'address.required' => 'La dirección de tienda es requerido',
            // 'city.required' => 'La ciudad de tienda es requerido',
            'latitude.required' => 'La ubicación de tienda es requerida',
            // 'longitude.required' => 'La longitud de tienda es requerido',
        ];

        // dd($this->address->ubigeo);
        $validator = Validator::make($this->address->toArray(), [
            'street' => ['required', 'string', 'min:1'],
            'secondary_street' => ['required', 'string', 'min:1'],
            'property_number' => ['required', 'string', 'min:1'],
            'document_number' => ['required', 'min:1'],
        ], $messages);

        if ($validator->fails()) {
            return false;
        }

        $validator = Validator::make($this->address->ubigeo->toArray(), [
            'state' => ['required', 'string', 'min:1'],
            'city' => ['required', 'string', 'min:1'],
            'district' => ['required', 'string', 'min:1'],
        ], $messages);

        if ($validator->fails()) {
            return false;
        }

        return true;
    }

    public function getFollowersFormatted()
    {
        return NumberFormatHelper::thousandsFormat($this->followers()->count());
    }
}