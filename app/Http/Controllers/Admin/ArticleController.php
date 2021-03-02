<?php

namespace App\Http\Controllers\Admin;

use Flash;
use Response;
use App\Helpers\JsonHelper;
use App\Http\Requests\Admin;
use App\Models\ArticleCategory;
use App\DataTables\Admin\ArticleDataTable;
use App\Http\Controllers\AppBaseController;
use App\Repositories\Admin\ArticleRepository;
use App\Http\Requests\Admin\CreateArticleRequest;
use App\Http\Requests\Admin\UpdateArticleRequest;

class ArticleController extends \App\Http\Controllers\Controller
{
    /** @var  ArticleRepository */
    private $articleRepository;

    public function __construct(ArticleRepository $articleRepo)
    {
        $this->articleRepository = $articleRepo;
    }

    /**
     * Display a listing of the Article.
     *
     * @param ArticleDataTable $articleDataTable
     * @return Response
     */
    public function index(ArticleDataTable $articleDataTable)
    {
        return $articleDataTable->render('admin.articles.index');
    }

    /**
     * Show the form for creating a new Article.
     *
     * @return Response
     */
    public function create()
    {   
        $plans = $plan = app('rinvex.subscriptions.plan')->all();
        $categories = ArticleCategory::all();
        return view('admin.articles.create', compact('categories', 'plans'));
    }

    /**
     * Store a newly created Article in storage.
     *
     * @param CreateArticleRequest $request
     *
     * @return Response
     */
    public function store(CreateArticleRequest $request)
    {
        $input = $request->all();

        $article = $this->articleRepository->create($input);

        if (isset($input['main_image'])) {
            $mainImage = JsonHelper::jsonOrEmpty($input['main_image']);
            if (!empty($mainImage)) {
                $article->saveMainImage($mainImage['path']);
            }
        }

        alert()->success('Asesoría creada');

        return redirect(route('admin.articles.index'));
    }

    
    public function edit($id)
    {
        $article = $this->articleRepository->findWithoutFail($id);

        if (empty($article)) {
            alert()->error('Asesoría no encontrada');

            return redirect(route('admin.articles.index'));
        }

        $plans = $plan = app('rinvex.subscriptions.plan')->all();
        $categories = ArticleCategory::all();

        return view('admin.articles.edit')->with(compact('article', 'categories', 'plans'));
    }

    
    public function update($id, UpdateArticleRequest $request)
    {
        $article = $this->articleRepository->findWithoutFail($id);

        if (empty($article)) {
            alert()->error('Asesoría no encontrada');

            return redirect(route('admin.articles.index'));
        }

        $article = $this->articleRepository->update($request->all(), $id);

        $images = $article->all_media;
        $input = request()->all();

        if (isset($input['main_image'])) {
            $mainImage = JsonHelper::jsonOrEmpty($input['main_image']);
            // dd($mainImage['path']);
            
            if (!isset($mainImage['manuallyAdded']) || !$mainImage['manuallyAdded']) {
                foreach ($images as $key => $image) {
                    if ($image->hasCustomProperty('isMain')) {
                        $image->delete();
                    }
                }

                $article->saveMainImage($mainImage['path']);
            }
        }

        alert()->success('Asesoría actualizada');

        return back();
    }

    /**
     * Remove the specified Article from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $article = $this->articleRepository->findWithoutFail($id);

        if (empty($article)) {
            alert()->error('Asesoría no encontrada');

            return redirect(route('admin.articles.index'));
        }

        $this->articleRepository->delete($id);

        alert()->success('Asesoría eliminada');

        return redirect(route('admin.articles.index'));
    }
}
