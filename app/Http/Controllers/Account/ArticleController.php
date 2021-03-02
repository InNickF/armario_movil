<?php

namespace App\Http\Controllers\Account;

use App\Repositories\Account\ArticleRepository;
use Yajra\DataTables\Utilities\Request;
use App\Models\Article;
use App\Models\ArticleCategory;
use SEO;

class ArticleController extends \App\Http\Controllers\Controller
{
    private $articleRepository;

    public function __construct(ArticleRepository $articleRepo)
    {
        $this->articleRepository = $articleRepo;
    }

    public function index($categoryId, Request $request)
    {
        $category = ArticleCategory::find($categoryId);

        if (!$category) {
            alert()->error('No se ha especificado una categoría');
            return back();
        }

        // dd($category->plan_id);
        if (!auth()->user()->canSeeArticleCategory($category)) {
            alert()->error('No tienes permiso para ver esto, necesitas un plan superior para continuar');
            // ->html('No tienes permiso para ver esto, necesitas un plan superior para continuar', '<a class="btn btn-outline-primary bg-transparent" href="' . url('account/plans') . '">VER PLANES</a>')->showConfirmButton('Omitir');
            return redirect(url('account/plans'));
        }

        $articles = Article::whereHas('categories', function ($query) use ($categoryId) {
            $query->where('article_categories.id', $categoryId);
        });

        $search = '';
        if ($request->has('search') && !empty($request->get('search'))) {
            $search = $request->get('search');
            $articles->where(function ($query) use ($search) {
                return $query->where('body', 'like', '%' . $search . '%')
                    ->orWhere('title', 'like', '%' . $search . '%');
            });
        }

        // dd($search);
        $articles = $articles->latest()->paginate(12);
        return view('account/articles/index', compact('articles', 'category', 'search'));
    }

    public function show($id)
    {
        $article = $this->articleRepository->findWithoutFail($id);


        if (empty($article)) {
            alert()->error('Article no encontrad@');

            return redirect(route('account.articles.index'));
        }

        SEO::setTitle($article->title);
        SEO::setDescription($article->description);
        SEO::opengraph()->setUrl(url()->current());
        SEO::setCanonical(url()->current());
        SEO::opengraph()->addProperty('type', 'website')->addProperty('image', $article->main_image);

        return view('account.articles.show')->with('article', $article);
    }
}