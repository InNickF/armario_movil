<?php

namespace App\Http\Controllers\Admin;

use Flash;
use Response;
use App\Helpers\JsonHelper;
use App\Http\Requests\Admin;
use App\Models\PostCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\DataTables\Admin\PostCategoryDataTable;
use App\Repositories\Admin\PostCategoryRepository;
use App\Http\Requests\Admin\CreatePostCategoryRequest;
use App\Http\Requests\Admin\UpdatePostCategoryRequest;

class PostCategoryController extends \App\Http\Controllers\Controller
{
    /** @var  PostCategoryRepository */
    private $postCategoryRepository;

    public function __construct(PostCategoryRepository $postCategoryRepo)
    {
        $this->postCategoryRepository = $postCategoryRepo;
    }

    /**
     * Display a listing of the PostCategory.
     *
     * @param PostCategoryDataTable $postCategoryDataTable
     * @return Response
     */
    public function index()
    {
        $categories = PostCategory::orderBy('order', 'asc')->renderAsArray();

        foreach ($categories as $key => &$category) {
            $category['link'] = route('admin.postCategories.edit', $category['id']);
        }
        return view('admin.post_categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new PostCategory.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.post_categories.create');
    }

    /**
     * Store a newly created PostCategory in storage.
     *
     * @param CreatePostCategoryRequest $request
     *
     * @return Response
     */
    public function store(CreatePostCategoryRequest $request)
    {
        $input = $request->all();

        $postCategory = $this->postCategoryRepository->create($input);

        if (isset($input['icon_image'])) {
            $iconImage = JsonHelper::jsonOrEmpty($input['icon_image']);
            if (!empty($iconImage)) {
                $postCategory->saveIconImage($iconImage['path']);
            }
        }

        alert()->success('Categoría guardada');

        return redirect(route('admin.postCategories.index'));
    }

    /**
     * Display the specified PostCategory.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $postCategory = $this->postCategoryRepository->findWithoutFail($id);

        if (empty($postCategory)) {
            alert()->error('Categoría no encontrada');

            return redirect(route('admin.postCategories.index'));
        }

        return view('admin.post_categories.show')->with('postCategory', $postCategory);
    }

    /**
     * Show the form for editing the specified PostCategory.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $postCategory = $this->postCategoryRepository->findWithoutFail($id);

        if (empty($postCategory)) {
            alert()->error('Categoría no encontrada');

            return redirect(route('admin.postCategories.index'));
        }

        return view('admin.post_categories.edit')->with(compact('postCategory'));
    }

    /**
     * Update the specified PostCategory in storage.
     *
     * @param  int              $id
     * @param UpdatePostCategoryRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePostCategoryRequest $request)
    {
        $postCategory = $this->postCategoryRepository->findWithoutFail($id);

        if (empty($postCategory)) {
            alert()->error('Categoría no encontrada');

            return redirect(route('admin.postCategories.index'));
        }

        $input = request()->all();

        $postCategory = $this->postCategoryRepository->update($input, $id);
        if (isset($input['icon_image'])) {
            $iconImage = JsonHelper::jsonOrEmpty($input['icon_image']);
            if (!empty($iconImage)) {
                $postCategory->saveIconImage($iconImage['path']);
            }
        }

        alert()->success('Categoría guardada');

        return redirect(url('admin/postCategories/' . $postCategory->id . '/edit'));
    }

    /**
     * Remove the specified PostCategory from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $postCategory = $this->postCategoryRepository->findWithoutFail($id);

        if (empty($postCategory)) {
            alert()->error('Categoría no encontrada');

            return redirect(route('admin.postCategories.index'));
        }

        $this->postCategoryRepository->delete($id);

        alert()->success('Categoría eliminada');

        return redirect(route('admin.postCategories.index'));
    }



    public function reorder(Request $request)
    {
        if (!isset($request->categories) || empty($request->categories)) {
            alert()->error('Categorías no cambiadas');
            return redirect(route('categories.index'));
        }

        $categories = json_decode($request->categories);

        // Go two levels down
        $order = 1;
        foreach ($categories as $categoryChanged) {
            $category = PostCategory::find($categoryChanged->id);
            $category->parent_id = null;
            $category->order = $order;
            $category->save();
            if (!empty($categoryChanged->children)) {
                foreach ($categoryChanged->children as $categoryChangedChild) {
                    $categoryChild = PostCategory::find($categoryChangedChild->id);
                    $categoryChild->parent_id = $category->id;
                    $category->order = $order;
                    $categoryChild->save();
                    $order++;
                }
            }
            $order++;
        }

        alert()->success('Categorías actualizadas');

        return redirect(route('admin.postCategories.index'));
    }
}
