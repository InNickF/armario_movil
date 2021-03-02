<?php

namespace App\Http\Controllers;

use Flash;
use Response;
use App\Models\Product;
use App\Models\Category;
use App\Models\UserStore;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AppBaseController;
use App\Models\Offer;
use App\Models\Question;
use SEO;

class ProductController extends \App\Http\Controllers\Controller
{


    public function show($storeSlug, $categorySlug, $subcategorySlug, $productSlug)
    {
        $product = Product::where('slug', $productSlug)->whereIsActive(true)->hasStock()->first();

        if (empty($product)) {
            alert()->error('Producto no encontrado');

            return back();
        }
        $store = UserStore::find($product->store_id);
        if (!$product->store || $product->store->is_offline || !$product->is_active) {
            alert()->error('Producto no disponible');

            return back();
        }

        SEO::setTitle($product->name);
        SEO::setDescription($product->description);
        SEO::opengraph()->setUrl(url()->current());
        SEO::setCanonical(url()->current());
        SEO::opengraph()->addProperty('type', 'website')->addProperty('image', $product->main_image);

        // $questions = Question::where('product_id', $product->id)->orderBy('created_at', 'desc')->get();

        $fashion = Product::notOffline()->categoryWithId($product->category_id)->plan('fashion')->latest()->whereIsActive(true)->hasStock()->get()->take(15);
        $cool_chic = Product::notOffline()->categoryWithId($product->category_id)->plan('cool')->planSecondary('chic')->latest()->whereIsActive(true)->hasStock()->get()->take(12);

        $recently_viewed = [];
        if (auth()->check()) {
            $recently_viewed = auth()->user()->getMostVisitedProducts();
        }
        // dd($recently_viewed);

        $user_id = null !== Auth::user() && !empty(Auth::user()) ? Auth::user()->id : null;

        return view('products.show')->with(compact(
            'product',
            'fashion',
            'cool_chic',
            'recently_viewed',
            // 'questions',
            'user_id'
        ));
    }
}
