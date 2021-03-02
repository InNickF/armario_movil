<?php

namespace App\Http\Controllers\Account;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AppBaseController;

class WishlistController extends \App\Http\Controllers\Controller
{
    
    public function index(Request $request)
    {
        $isLoggedIn = Auth::check();
        $user = Auth::user();

        $wishlist = $user->favorites(Product::class);
        // dd($wishlist);
        $categories = Category::where('parent_id', null)->get();

        $filtered_category = $request->get('category', null);
        $order = $request->get('order', 'created_at');
        $search = $request->get('search', null);
        
        if ($filtered_category) {
            $wishlist->where('products.category_id', $filtered_category);
        }
        
        if ($order) {
            if($order == 'name') {
                $wishlist->orderBy('products.name', 'asc');
            } else {
                $wishlist->orderBy('followables.created_at', 'desc');
            }
        } 

        if ($search) {
            $wishlist->where('products.name', 'like', '%' . $search . '%');
        }
        
        $wishlist = $wishlist->get();
        // dd($wishlist);

        return view('account.wishlist.index', compact('isLoggedIn', 'wishlist', 'user', 'categories', 'filtered_category', 'order', 'search'));
    }

    
}
