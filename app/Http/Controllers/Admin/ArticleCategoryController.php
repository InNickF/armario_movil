<?php

namespace App\Http\Controllers\Admin;

use Flash;
use Response;
use App\Helpers\JsonHelper;
use App\Http\Requests\Admin;
use Illuminate\Http\Request;
use App\Models\ArticleCategory;
use App\Http\Controllers\AppBaseController;
use App\DataTables\Admin\ArticleCategoryDataTable;
use App\Repositories\Admin\ArticleCategoryRepository;
use App\Http\Requests\Admin\CreateArticleCategoryRequest;
use App\Http\Requests\Admin\UpdateArticleCategoryRequest;

class ArticleCategoryController extends \App\Http\Controllers\Controller
{
    /** @var  ArticleCategoryRepository */
    private $articleCategoryRepository;

    public function __construct(ArticleCategoryRepository $articleCategoryRepo)
    {
        $this->articleCategoryRepository = $articleCategoryRepo;
    }

    /**
     * Display a listing of the ArticleCategory.
     *
     * @param ArticleCategoryDataTable $articleCategoryDataTable
     * @return Response
     */
    public function index()
    {   
        \Log::error('asdasdasd');
        $categories = ArticleCategory::orderBy('order', 'asc')->renderAsArray();
        foreach ($categories as $key => &$category) {
            $category['link'] = route('admin.articleCategories.edit', $category['id']);
        }
        return view('admin.article_categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new ArticleCategory.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.article_categories.create');
    }

    /**
     * Store a newly created ArticleCategory in storage.
     *
     * @param CreateArticleCategoryRequest $request
     *
     * @return Response
     */
    public function store(CreateArticleCategoryRequest $request)
    {
        $input = $request->all();
        $lastCategory = ArticleCategory::orderBy('order', 'desc')->first() ? ArticleCategory::orderBy('order', 'desc')->first()->order : 0;
        $input['order'] = $lastCategory + 1;

        $articleCategory = $this->articleCategoryRepository->create($input);

        if (isset($input['icon_image'])) {
            $iconImage = JsonHelper::jsonOrEmpty($input['icon_image']);
            if (!empty($iconImage)) {
                $articleCategory->saveIconImage($iconImage['path']);
            }
        }

        alert()->success('Categoría saved successfully.');

        return redirect(route('admin.articleCategories.index'));
    }

    public function reorder(Request $request)
    {
        if (!isset($request->categories) || empty($request->categories)) {
            alert()->error('Categories no encontrad@');
            return redirect(route('categories.index'));
        }
        
        $categories = json_decode($request->categories);

        // Go two levels down
        $order = 1;
        foreach ($categories as $categoryChanged) {
            $category = ArticleCategory::find($categoryChanged->id);
            $category->parent_id = null;
            $category->order = $order;
            $category->save();
            if (!empty($categoryChanged->children)) {
                foreach ($categoryChanged->children as $categoryChangedChild) {
                    $categoryChild = ArticleCategory::find($categoryChangedChild->id);
                    $categoryChild->parent_id = $category->id;
                    $category->order = $order;
                    $categoryChild->save();
                    $order ++;
                }
            }
            $order ++;
        }

        alert()->success('Categories actualizad@ exitosamente.');

        return redirect(route('admin.articleCategories.index'));
    }


    /**
     * Display the specified ArticleCategory.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $articleCategory = $this->articleCategoryRepository->findWithoutFail($id);

        if (empty($articleCategory)) {
            alert()->error('Categoría no encontrad@');

            return redirect(route('admin.articleCategories.index'));
        }

        return view('admin.article_categories.show')->with('articleCategory', $articleCategory);
    }

    /**
     * Show the form for editing the specified ArticleCategory.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $articleCategory = $this->articleCategoryRepository->findWithoutFail($id);

        if (empty($articleCategory)) {
            alert()->error('Categoría no encontrada');

            return redirect(route('admin.articleCategories.index'));
        }

        $plans = app('rinvex.subscriptions.plan')->whereIn('slug', ['ropero', 'armario', 'closet'])->get();

        return view('admin.article_categories.edit')->with(compact('articleCategory', 'plans'));
    }

    /**
     * Update the specified ArticleCategory in storage.
     *
     * @param  int              $id
     * @param UpdateArticleCategoryRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateArticleCategoryRequest $request)
    {
        $articleCategory = $this->articleCategoryRepository->findWithoutFail($id);

        if (empty($articleCategory)) {
            alert()->error('Categoría no encontrad@');

            return redirect(route('admin.articleCategories.index'));
        }

        $input = $request->all();
    

        if (isset($input['icon_image'])) {
			$iconImage = JsonHelper::jsonOrEmpty($input['icon_image']);
			if (!isset($iconImage['manuallyAdded']) || !$iconImage['manuallyAdded']) {
                // dd($iconImage);
                $images = $articleCategory->getAllMedia();
				foreach ($images as $key => $image) {
					if ($image->hasCustomProperty('isIcon')) {
						$image->delete();
					}
				}
				$articleCategory->saveIconImage($iconImage['path']);
			}
		}

        $articleCategory = $this->articleCategoryRepository->update($input, $id);

        alert()->success('Categoría actualizad@ exitosamente.');

        return back();
    }

    /**
     * Remove the specified ArticleCategory from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $articleCategory = $this->articleCategoryRepository->findWithoutFail($id);

        if (empty($articleCategory)) {
            alert()->error('Categoría no encontrad@');

            return redirect(route('admin.articleCategories.index'));
        }

        $this->articleCategoryRepository->delete($id);

        alert()->success('Categoría eliminad@ exitosamente.');

        return redirect(route('admin.articleCategories.index'));
    }
}
