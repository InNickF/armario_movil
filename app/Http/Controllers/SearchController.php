<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\UserStore;
use Illuminate\Http\Request;
use SEO;

class SearchController extends Controller
{
	public function index(Request $request)
	{


		SEO::setTitle('Búsqueda');
		SEO::setDescription('Búsqueda de productos');
		SEO::opengraph()->setUrl(url()->current());
		SEO::setCanonical(url()->current());
		SEO::opengraph()->addProperty('type', 'website');


		if (!$request->q) {
			alert()->info('Ingresa un texto en el campo para realizar una búsqueda');
			return redirect(url('/'));
		}

		$search = $request->get('q');

		$products = Product::notOffline()->whereIsActive(true)->hasStock()
			->where(function ($query) use ($search) {
				$query->where('name', 'like', '%' . $search . '%')
					->orWhere('description', 'like', '%' . $search . '%')
					->orWhere(function ($q) use ($search) {
						$q->categoryWithId($search);
					})
					->orWhereHas('store', function ($s) use ($search) {
						$s->where('name', 'like', '%' . $search . '%');
					});
			})->paginate(20);

		$stores = UserStore::where('name', 'like', '%' . $search . '%')
			->orWhereHas('address', function ($address) use ($search) {
				$address->where('city', 'like', $search);
			})->orWhere('description', 'like', '%' . $search . '%')->notOffline()->paginate(20);

		return view('search.index', compact('products', 'stores', 'search'));
	}
}