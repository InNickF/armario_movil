<?php

namespace App\Http\Controllers;

use App\Criteria\NotOfflineCriteria;
use App\Models\Category;
use App\Models\Product;
use App\Models\Slider;
use App\Repositories\ProductRepository;
use SEO;

class CategoryController extends Controller
{
    protected $prodRepo;

    public function __construct(ProductRepository $prodRepo)
    {
        $this->prodRepo = $prodRepo;
        $this->prodRepo->pushCriteria(NotOfflineCriteria::class);
    }

    public function show($slug)
    {
        $category = Category::where('slug', $slug)->first();

        $cool = Product::notOffline()->categoryWithId($category->id)->with('store')->plan('cool')->whereIsActive(true)->hasStock()->latest()->take(8)->get();
        $banners_top = Slider::where('position', 'category_top')->where('type', 'banner')->where('category_id', $category->id)->first()->slides ?? [];
        $banners_bottom = Slider::where('position', 'category_bottom')->where('type', 'banner')->where('category_id', $category->id)->first()->slides ?? [];

        SEO::setTitle($category->name);
        SEO::setDescription($category->description);
        SEO::opengraph()->setUrl(url()->current());
        SEO::setCanonical(url()->current());
        SEO::opengraph()->addProperty('type', 'website')->addProperty('image', $category->icon_image_jpg);

        return view('categories.show')->with(compact(
            'cool',
            'banners_top',
            'banners_bottom',
            'category'
        ));
    }
}