<?php

namespace App\Http\Controllers\API;

use App\Criteria\NotOfflineCriteria;
use App\Http\Requests\API\CreateProductAPIRequest;
use App\Http\Requests\API\UpdateProductAPIRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductSize;
use App\Models\ProductVariant;
use App\Notifications\ProductAddedToWishlist;
use App\Notifications\ProductRemovedFromWishlist;
use App\Repositories\ProductRepository;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\Filter;
use Spatie\QueryBuilder\QueryBuilder;

class ProductAPIController extends \App\Http\Controllers\Controller
{
    /** @var ProductRepository */
    private $productRepository;

    public function __construct(ProductRepository $productRepo)
    {
        $this->productRepository = $productRepo;
        $this->productRepository->pushCriteria(NotOfflineCriteria::class);
    }

    public function index(Request $request)
    {
        return QueryBuilder::for(Product::class)
            ->with(['store', 'category', 'subcategory'])
            ->allowedIncludes('store', 'questions', 'category', 'subcategory', 'subsubcategory', 'plans', 'variants')
            ->allowedFilters(
                Filter::exact('store_id'),
                'name',
                'description',
                'is_active',
        // Filter::scope('category_with_id'),
        Filter::exact('category_id'),
                Filter::exact('subcategory_id'),
                Filter::exact('subsubcategory_id'),
                'style',
                Filter::scope('price'),
                Filter::scope('size'),
                Filter::scope('color'),
                Filter::scope('search'),
                Filter::scope('plan'),
                Filter::scope('plan_secondary'),
                Filter::scope('store_plan'),
                Filter::scope('city'),
                Filter::scope('followed_categories'),
                Filter::scope('has_stock')
            )
            ->defaultSort('created_at')
            ->allowedSorts('name', 'created_at')
      // ->allowedAppends('url', 'final_price', 'ad_type', 'is_favorited', 'colors', 'sizes') // Appends attributes that are not in $appends in Model
            ->where('products.is_active', true)
            ->notOffline()
      // ->hasStock()
            ->paginate($request->query('limit'))
    ;
    }

    public function store(CreateProductAPIRequest $request)
    {
        if (!auth('api')->user()->canCreateProduct()) {
            return $this->sendError('No puedes crear más productos con tu plan actual, actualiza tu suscripción para crear más productos');
        }

        $input = $request->all();

        $variants = ($input['variants']);
        unset($input['variants']);
        if (!isset($variants) || empty($variants)) {
            return $this->sendError('Se requiere subir al menos un color del producto');
        }

        if (!isset($input['colors_media']) || empty($input['colors_media'])) {
            return $this->sendError('Se requiere subir al menos una imagen por cada color del producto');
        }

        $input['store_id'] = auth('api')->user()->store->id;

        $mediaByColor = ($input['colors_media']); // [color => [img1,img2,vd1]]
        unset($input['colors_media'], $input['total_stock']);

        $input['final_price'] = $input['has_discount'] ? $input['discounted_price'] : $input['price'];
        $product = Product::create($input);

        foreach ($variants as $key => $variant) {
            unset($variant['id']); // This ID is from JS and has to be removed
            $variant['product_id'] = $product->id;
            $variant = ProductVariant::create($variant);
        }

        if (!empty($mediaByColor)) {
            foreach ($mediaByColor as $colorName => $paths) {
                if (!empty($paths)) {
                    foreach ($paths as $key => $path) {
                        $product->saveColorImage($key, $colorName, $path);
                    }
                }
            }
        }

        $plan = app('rinvex.subscriptions.plan')->where('slug', 'cool')->first();
        $product->newSubscription('main', $plan);

        return $product;
    }

    public function show($id)
    {
        $product = QueryBuilder::for(Product::class)
            ->allowedIncludes('store', 'questions', 'category', 'subcategory', 'subsubcategory', 'variants', 'outfits')
            ->allowedFilters(
                'name',
                'description',
                'is_active',
                Filter::exact('category_id'),
                Filter::scope('search'),
                Filter::scope('not_offline'),
                'style',
                Filter::scope('city'),
                'reviews',
                Filter::scope('has_stock')
            )
            ->allowedAppends('final_price', 'ad_type', 'is_favorited', 'colors', 'sizes')
            ->storeHasAddress()
    ;
        // ->hasStock()
        // ->notOffline();

        $product = $product->find($id);

        if (empty($product)) {
            return $this->sendError('Producto no disponible, puede que se haya agotado o que la tienda se encuentre inactiva');
        }

        // If is not owner show only if is_active
        if (!auth('api')->check() || (auth('api')->check() && $product->store->user->id != auth('api')->user()->id)) {
            if (!$product->is_active) {
                return $this->sendError('Producto inactivo');
            }
        }

        return $product;
    }

    public function update($id, UpdateProductAPIRequest $request)
    {
        $input = $request->all();
        \Log::info(json_encode($input));
        // @var Product $product
        $this->productRepository->popCriteria(NotOfflineCriteria::class);
        $product = Product::find($id);

        if (empty($product)) {
            return $this->sendError('Producto no encontrado');
        }

        $variants = ($input['variants']);
        unset($input['variants']);
        if (!isset($variants) || empty($variants)) {
            return $this->sendError('Se requiere subir al menos un color del producto');
        }

        if (!isset($input['colors_media']) || empty($input['colors_media'])) {
            return $this->sendError('Se requiere subir al menos una imagen por cada color del producto');
        }

        $input['store_id'] = auth('api')->user()->store->id;

        $mediaByColor = ($input['colors_media']); // [color => [img1,img2,vd1]]
        unset($input['colors_media'], $input['colors_media_thumbs'], $input['all_media'], $input['media'], $input['favoriters'], $input['plan'], $input['total_stock']);

        $input['final_price'] = $input['has_discount'] ? $input['discounted_price'] : $input['price'];
        $product = $this->productRepository->update($input, $id);

        if (!empty($variants)) {
            foreach ($variants as $key => $variant) {
                // Check if variant exists
                $existingVariant = $product->variants()->find($variant['id']);

                if ($existingVariant && $existingVariant->exists()) {
                    // Just update
                    $existingVariant->update($variant);
                } else {
                    // Create the variant
          unset($variant['id']); // This ID is from JS and has to be removed
          $variant['product_id'] = $product->id;
                    $existingVariant = ProductVariant::create($variant);
                }
            }
        }

        // Link images
        if (!empty($mediaByColor)) {
            foreach ($mediaByColor as $colorName => $paths) {
                if (!empty($paths)) {
                    foreach ($paths as $key => $path) {
                        $hasChanged = true;
                        foreach ($product->media as $media) {
                            if (
                                $media->hasCustomProperty('key')
                                && $media->getCustomProperty('key') == $key
                                && $media->hasCustomProperty('color')
                                && $media->getCustomProperty('color') == $colorName
                              ) {
                                if (false !== strpos($path, 'http')) { // Has not changed because is URL, if not would be a path
                                    $hasChanged = false;

                                    continue;
                                }
                                $media->delete();
                            }
                        }

                        if (!$hasChanged) {
                            continue;
                        }
                        $product->saveColorImage($key, $colorName, $path);
                    }
                }
            }

            foreach ($product->media as $media) {
                $keyToFind = $media->getCustomProperty('key');
                $colorToFind = $media->getCustomProperty('color');
                $deleted = true;

                foreach ($mediaByColor as $colorName => $paths) {
                    foreach ($paths as $key => $path) {
                        if (
                          $keyToFind == $key && $colorToFind == $colorName
                        ) {
                            $deleted = false;
                        }
                    }
                }

                if ($deleted) {
                    $media->delete();
                }
            }
        }

        // Remove not present in both variants and color media
        $existingVariantColors = collect($product->variants)->mapWithKeys(function ($v) {
            return [$v->id => $v->color];
        }); // ['black' => 23, ...]

        $toDelete = $existingVariantColors->except(collect($variants)->pluck('id'));

        if ($toDelete->count()) {
            foreach ($toDelete as $variantId => $colorName) {
                // Delete variant
                $variant = ProductVariant::find($variantId);
                $variant->delete();

                // Delete media
                foreach ($product->media as $image) {
                    if (
            $image->hasCustomProperty('color')
            && $image->getCustomProperty('color') == $colorName
          ) {
                        $image->delete();
                    }
                }
            }
        }

        return Product::find($id);
    }

    public function destroy($id)
    {
        /** @var Product $product */
        $product = $this->productRepository->findWithoutFail($id);

        if (empty($product)) {
            return $this->sendError('Producto no encontrado');
        }

        if ($product->store->id != auth('api')->user()->store->id) {
            return $this->sendError('No se permite esta acción');
        }

        $product->delete();

        return $this->sendResponse($id, 'Product ha sido eliminado');
    }

    public function plans()
    {
        $plans = app('rinvex.subscriptions.plan')->with('features')->whereIn('slug', ['cool', 'chic', 'fashion'])->orderBy('id', 'asc')->get();

        if (!$plans->count()) {
            return $this->sendError('Plans not obtained', 404);
        }

        return $this->sendResponse($plans, 'Plans obtained successfully');
    }

    public function sizes($productCategoryId)
    {
        if (0 == $productCategoryId) {
            return $this->sendResponse(ProductSize::with('categories')->get(), 'All Sizes obtained successfully');
        }

        $category = Category::find($productCategoryId);
        if (!$category) {
            return $this->sendError('Category not found');
        }

        $sizes = ProductSize::has('categories')->with('categories')->whereHas('categories', function ($c) use ($productCategoryId) {
            $c->where('categories.id', $productCategoryId);
        })->get();

        return $this->sendResponse($sizes, 'Sizes obtained successfully');
    }

    public function payPlan($productId, $planId)
    {
        // payment is Paymentez response object
        if (!request()->has('payment')) {
            return $this->sendError('Datos no válidos');
        }

        $product = Product::find($productId);
        $plan = app('rinvex.subscriptions.plan')->find($planId);

        \Log::info('ProductAPIController pay product plan'.$productId);

        if (!$product) {
            return $this->sendError('No se ha encontrado el producto');
        }

        if (!$plan) {
            return $this->sendError('No se ha encontrado el plan');
        }

        if ($product->store->user->id != auth('api')->user()->id) {
            return $this->sendError('Permiso denegado');
        }

        // Change plan and Generate transaction
        try {
            $product->onPlanPaid(request('payment'), $plan);
            \Log::info('ProductAPIController after onPlanPaid product updated '.$productId);
        } catch (\Throwable $th) {
            return $this->sendError($th->getMessage());
            \Log::error($th);
        }

        return $this->sendResponse($plan, 'El plan de anuncios del producto ha sido actualizado');
    }

    public function toggleFavorite($id)
    {
        if (!auth('api')->check()) {
            return $this->sendError('Inicia sesión para activar tu lista de deseados');
        }

        $product = Product::find($id);
        $user = auth('api')->user();
        $user->toggleFavorite($product);

        $hasFavorited = auth('api')->user()->hasFavorited($product);
        if ($hasFavorited) {
            alert()->success('Has agregado '.$product->name.' a tu lista de deseados');
            // Notify to Product Owner
            $product->store->user->notify(new ProductAddedToWishlist($product, $user));
        } else {
            alert()->success('Has borrado '.$product->name.' a tu lista de deseados');
            // Notify to Product Owner
            $product->store->user->notify(new ProductRemovedFromWishlist($product, $user));
        }

        return $this->sendResponse(['is_favorite' => $hasFavorited], 'Producto agregado/borrado de lista de deseados');
    }

    public function reviews($productId)
    {
        $reviews = Product::find($productId)->getReviews()->with('user')->paginate(5);

        return $this->sendResponse($reviews, 'Reviews obtained successfully');
    }
}