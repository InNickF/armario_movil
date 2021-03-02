<?php

namespace App\Http\Controllers\Account;

use App\Models\Category;
use App\Models\UserStore;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AppBaseController;
use App\Models\Outfit;

class OutfitController extends \App\Http\Controllers\Controller
{

    public function index(Request $request)
    {
        $categories = \App\Models\Category::whereNull('parent_id')->get();

        $outfits = Outfit::where([
            'store_id' => Auth::user()->store->id
        ])->orderBy('created_at', 'desc');

        if ($request->has('category') && !empty($request->query('category'))) {
            $outfits->whereHas('categories', function ($query) use ($request) {
                return $query->whereId($request->query('category'));
            });
        }

        return view('account.outfits.index', [
            'filtered_category' => $request->query('category'),
            'categories' => $categories,
            'outfits' => $outfits->get(),
        ]);
    }


    public function create()
    {
        $categories = Category::all();
        $stores = UserStore::all();
        return view('account.outfits.create')->withCategories($categories)->withStores($stores)->withUser(Auth::user());
    }


    public function edit($id)
    {
        $outfit = Outfit::with('products')->find($id);
        $user = Auth::user();

        if ($user->isNotA('super-user')) {
            if ($outfit->store_id != $user->store->id) {
                abort(403);
            }
        }

        if (empty($outfit)) {
            alert()->error('Outfit no encontrad@');

            return redirect(route('account.outfits.index'));
        }


        // ! accessor for 'media' was not returning the video element, fixed below
        $media = $outfit->media;
        $outfit = $outfit->toArray();
        $outfit['media'] = $media;


        return view('account.outfits.edit')
            ->with(compact('outfit', 'user'));
    }


    public function destroy($id)
    {
        $outfit = Outfit::find($id);

        if (empty($outfit)) {
            alert()->error('Outfit no encontrad@');

            return redirect(route('account.outfits.index'));
        }

        if (Auth::user()->isNotA('super-user')) {
            if ($outfit->store_id != Auth::user()->store->id) {
                abort(403);
            }
        }

        $outfit->delete();

        alert()->success('Outfit eliminad@ exitosamente.');

        return redirect(route('account.outfits.index'));
    }
}