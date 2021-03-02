<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Order;
use App\Models\Outfit;
use App\Models\Slider;
use App\Models\UserStore;
use App\User;

class HomeController extends Controller
{
    public function index()
    {
        // Ofertados: cool (free) product plan
        // $plan = app('rinvex.subscriptions.plan')->where('slug', 'fashion')->first();

        // if($plan) {
        //     $fashion = Product::plan($plan->slug)->take(8)->get();
        // } else {
        //     $fashion = [];
        // }

        $userHasFollowedCategories = false;
        // dd($fashion);
        // Outfits
        $outfits = Outfit::with(['store', 'products'])->hasStock()->whereHas('products', function ($p) {
            $p->hasStock();
        })->whereHas('store', function ($store) {
            $store->notOffline();
        })->latest()->take(12)->get();

        // If user has followed categories, filter results
        if (auth()->check() && auth()->user()->followings(Category::class)->count()) {
            $outfits = $outfits->filter(function ($o) {
                return auth()->user()->followings(Category::class)->whereIn('id', $o->categories->pluck('id'))->count();
            });
            $userHasFollowedCategories = true;
        }

        $outfits = $outfits->take(15);

        $categories = Category::with(['main_products.store', 'main_products.variants', 'main_products.category', 'main_products.subcategory'])
            ->orderBy('order', 'asc')
            ->where('parent_id', null)
            ->get()
            ->mapWithKeys(function ($cat) {
                return [
                    $cat->name => $cat->main_products()->plan('cool')->notOffline()->whereIsActive(true)->hasStock()->latest()->take(12)->get(),
                ];
            })
        ;

        $storesWithActiveStories = UserStore::with(['latest_story', 'active_stories'])->has('active_stories')->has('latest_story')->get();
        // dd($storesWithActiveStories->toArray());
        // Order by most recent story
        $storesWithActiveStories = $storesWithActiveStories->sortByDesc('latest_story.created_at')->flatten();

        // Check stores followed by logged user and put those stores first in results
        // if(auth()->check()) {
        //     // Check if user is following stores to filter according to that
        //     $followedStores = auth()->user()->followings(UserStore::class)->get();
        //     if($followedStores->count()) {
        //         // $storesWithActiveStories->whereIn('id', $followedStores->pluck('id'));

        //         foreach ($storesWithActiveStories as $key => $store) {
        //             $followed = $followedStores->firstWhere('id', $store->id);
        //             if($followed){
        //                 $pulledFollowedStore = $storesWithActiveStories->pull($key);
        //                 $storesWithActiveStories->prepend($pulledFollowedStore);
        //             };
        //         }
        //     }
        // }

        // dd( $storesWithActiveStories);

        // *Sliders
        $home_top_slider = Slider::has('slides')->where('position', 'home_top')->where('type', 'slider')->latest()->first();
        $top_banner = Slider::has('slides')->where('position', 'home_banner')->where('type', 'banner')->latest()->first();
        $offer_slider = Slider::has('slides')->where('position', 'home_bottom')->where('type', 'banner')->latest()->first();

        // dd($storesWithActiveStories );
        // Statistics sectio
        $stats = [
            setting('statistics_1_title') => setting('statistics_1_value'),
            setting('statistics_2_title') => setting('statistics_2_value'),
            setting('statistics_3_title') => setting('statistics_3_value'),
            setting('statistics_4_title') => setting('statistics_4_value'),
        ];

        return view('home')->with(compact(
            'categories',
            // 'featured_products',
            // 'fashion', // Slider de producto individual
            'top_banner', // Banners abajo de slider
            'offer_slider', // Banners abajo de slider
            'outfits',
            'stats',
            'storesWithActiveStories',
            'userHasFollowedCategories',
            'home_top_slider'
        ));
    }
}