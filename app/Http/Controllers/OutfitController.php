<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use SEO;
use App\Models\Outfit;
use App\Models\Product;
use App\Models\UserStore;
use Illuminate\Support\Facades\Auth;

class OutfitController extends Controller
{


    public function show($storeSlug, $outfitSlug)
    {
        // dd('asdsadasdadfsa');
        $outfit = Outfit::with('products')->whereHas('store')->whereHas('products', function ($p) {
            $p->hasStock();
        })->where('slug', $outfitSlug)->first();

        if (empty($outfit)) {
            alert()->error('Outfit no encontrado');

            return back();
        }

        // ! accessor for 'media' was not returning the video element, fixed below
        $media = $outfit->media;
        $outfitArray = $outfit->toArray();
        $outfitArray['media'] = $media;


        $store = UserStore::find($outfit->store_id);

        // dd($store);

        if (!$outfit->store || $outfit->store->is_offline) {
            alert()->error('Outfit no disponible');

            return back();
        }

        if (!$outfit->hasStock()->count()) {
            alert()->error('Uno o más productos del conjunto se encuentran agotados');

            return back();
        }

        // dd($outfit->store->address);

        SEO::setTitle($outfit->name);
        SEO::setDescription($outfit->description);
        SEO::opengraph()->setUrl(url()->current());
        SEO::setCanonical(url()->current());
        SEO::opengraph()->addProperty('type', 'website')->addProperty('image', $outfit->main_image);

        $fashion = Product::notOffline()->plan('fashion')->latest()->whereIsActive(true)->hasStock()->get()->take(15);
        $cool_chic = Product::notOffline()->plan('cool')->planSecondary('chic')->latest()->whereIsActive(true)->hasStock()->get()->take(12);


        $recently_viewed = [];
        if (auth()->check()) {
            $recently_viewed = auth()->user()->getMostVisitedProducts();
        }
        // dd($recently_viewed);

        $user_id = null !== Auth::user() && !empty(Auth::user()) ? Auth::user()->id : null;




        return view('outfits.show')->with(compact(
            'outfit',
            'outfitArray',
            'fashion',
            'cool_chic',
            'recently_viewed',

            'user_id'
        ));
    }
}
