<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use App\Models\FaqCategory;
use SEO;

class FaqsController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$faqs = Faq::latest();

		$search = request()->get('search');

		if ($search) {
			$faqs->where('title', 'LIKE', "%{$search}%")->orWhere('body', 'LIKE', "%{$search}%");
		}

		$faqs = $faqs->paginate(20);
		$categories = FaqCategory::all();

		SEO::setTitle('Preguntas Frecuentes');
		SEO::setDescription('Preguntas Frecuentes sobre la plataforma');
		SEO::opengraph()->setUrl(url()->current());
		SEO::setCanonical(url()->current());
		SEO::opengraph()->addProperty('type', 'website');

		return view('faqs.index')->with(compact('faqs', 'categories', 'search'));
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Faq  $faq
	 * @return \Illuminate\Http\Response
	 */
	public function show($slug)
	{
		$faq = Faq::where('slug', $slug)->first();

		if (!$faq) {
			abort(403);
		}

		SEO::setTitle($faq->title);
		SEO::setDescription($faq->description);
		SEO::opengraph()->setUrl(url()->current());
		SEO::setCanonical(url()->current());
		SEO::opengraph()->addProperty('type', 'website');

		$nextFaq = Faq::whereHas('categories', function ($cat) use ($faq) {
			return $cat->whereIn('category_id', $faq->categories->pluck('id', 'id'));
		})->where('id', '>', $faq->id)->first();

		$prevFaq = Faq::whereHas('categories', function ($cat) use ($faq) {
			return $cat->whereIn('category_id', $faq->categories->pluck('id', 'id'));
		})->where('id', '<', $faq->id)->first();

		return view('faqs.show', compact('faq', 'nextFaq', 'prevFaq'));
	}

	public function category($slug)
	{
		$category = FaqCategory::where('slug', $slug)->first();

		if (!$category) {
			abort(403);
		}

		$faqs = Faq::with('categories')->whereHas('categories', function ($cat) use ($category) {
			return $cat->where('category_id', $category->id);
		})->get();

		$titulo = "";

		// dd($faqs->toArray());

		return view('faqs.category', compact('faqs', 'category', 'titulo'));
	}
}