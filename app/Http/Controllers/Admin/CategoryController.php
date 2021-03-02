<?php

namespace App\Http\Controllers\Admin;

use Flash;
use Response;
use App\Models\Category;
use App\Helpers\JsonHelper;
use App\Http\Requests\Admin;
use Illuminate\Http\Request;
use App\Repositories\CategoryRepository;
use App\DataTables\Admin\CategoryDataTable;
use App\Http\Controllers\AppBaseController;
use App\Http\Requests\Admin\CreateCategoryRequest;
use App\Http\Requests\Admin\UpdateCategoryRequest;

class CategoryController extends \App\Http\Controllers\Controller
{
    /** @var  CategoryRepository */
    private $categoryRepository;

    public function __construct(CategoryRepository $categoryRepo)
    {
        $this->categoryRepository = $categoryRepo;
    }

    /**
     * Display a listing of the Category.
     *
     * @param CategoryDataTable $categoryDataTable
     * @return Response
     */
    public function index(CategoryDataTable $categoryDataTable)
    {

        $categories = Category::orderBy('order', 'asc')->renderAsArray();

        return $categoryDataTable->render('admin.categories.index')->with('categories', $categories);
    }


    public function reorder(Request $request)
    {
        if (!isset($request->categories) || empty($request->categories)) {
            alert()->error('Categorías no encontradas');
            return redirect(route('categories.index'));
        }

        $categories = json_decode($request->categories);

        // Go two levels down
        $order = 1;
        foreach ($categories as $categoryChanged) {
            $category = Category::find($categoryChanged->id);
            $category->parent_id = null;
            $category->order = $order;
            $category->save();
            if (!empty($categoryChanged->children)) {
                foreach ($categoryChanged->children as $categoryChangedChild) {
                    $categoryChild = Category::find($categoryChangedChild->id);
                    $categoryChild->parent_id = $category->id;
                    $categoryChild->order = $order;
                    $categoryChild->save();
                    $order++;


                    if (!empty($categoryChangedChild->children)) {
                        foreach ($categoryChangedChild->children as $categoryChangedChildChild) {
                            $categoryChildChild = Category::find($categoryChangedChildChild->id);
                            $categoryChildChild->parent_id = $categoryChild->id;
                            $categoryChildChild->order = $order;
                            $categoryChildChild->save();
                            $order++;
                        }
                    }
                }
            }
            $order++;
        }

        alert()->success('Categorías actualizadas');

        return redirect(route('admin.categories.index'));
    }

    /**
     * Show the form for creating a new Category.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created Category in storage.
     *
     * @param CreateCategoryRequest $request
     *
     * @return Response
     */
    public function store(CreateCategoryRequest $request)
    {
        $input = $request->all();
        $input['order'] = Category::orderBy('order', 'desc')->first()->order + 1;
        $category = $this->categoryRepository->create($input);

        if (isset($input['icon_image'])) {
            $iconImage = JsonHelper::jsonOrEmpty($input['icon_image']);
            if (!empty($iconImage)) {
                $category->saveIconImage($iconImage['path']);
            }
        }

        if (isset($input['icon_image_jpg'])) {
            $iconImage = JsonHelper::jsonOrEmpty($input['icon_image_jpg']);
            if (!empty($iconImage)) {
                $category->saveIconImageJpg($iconImage['path']);
            }
        }



        alert()->success('Categoría creada');

        return redirect(route('admin.categories.index'));
    }

    /**
     * Display the specified Category.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $category = $this->categoryRepository->findWithoutFail($id);

        if (empty($category)) {
            alert()->error('Categoría no encontrada');

            return redirect(route('categories.index'));
        }

        return view('admin.categories.show')->with('category', $category);
    }

    /**
     * Show the form for editing the specified Category.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $category = $this->categoryRepository->findWithoutFail($id);

        if (empty($category)) {
            alert()->error('Categoría no encontrada');

            return redirect(route('categories.index'));
        }

        return view('admin.categories.edit')->with('category', $category);
    }

    /**
     * Update the specified Category in storage.
     *
     * @param  int              $id
     * @param UpdateCategoryRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCategoryRequest $request)
    {
        $category = $this->categoryRepository->findWithoutFail($id);

        if (empty($category)) {
            alert()->error('Category no encontrad@');

            return redirect(route('admin.categories.index'));
        }

        $input = $request->all();
        $category = $this->categoryRepository->update($input, $id);


        $images = $category->getAllMedia();
        if (isset($input['icon_image']) && !empty($input['icon_image']) && is_string($input['icon_image'])) {
            $iconImage = JsonHelper::jsonOrEmpty($input['icon_image']);
            if (!isset($iconImage['manuallyAdded']) || !$iconImage['manuallyAdded']) {
                foreach ($images as $key => $image) {
                    if ($image->hasCustomProperty('isMain')) {
                        $image->delete();
                    }
                }

                $category->saveIconImage($iconImage['path']);
                // dd($iconImage);
            }
        }

        if (isset($input['icon_image_jpg']) && !empty($input['icon_image_jpg']) && is_string($input['icon_image_jpg'])) {
            $iconImage = JsonHelper::jsonOrEmpty($input['icon_image_jpg']);
            if (!isset($iconImage['manuallyAdded']) || !$iconImage['manuallyAdded']) {
                foreach ($images as $key => $image) {
                    if ($image->hasCustomProperty('isJpg')) {
                        $image->delete();
                    }
                }

                $category->saveIconImageJpg($iconImage['path']);
            }
        }

        alert()->success('Categoría actualizada');

        return back();
    }










    /**
     * Remove the specified Category from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $category = $this->categoryRepository->findWithoutFail($id);

        if (empty($category)) {
            alert()->error('Category no encontrad@');

            return redirect(route('admin.categories.index'));
        }

        $this->categoryRepository->delete($id);

        alert()->success('Category eliminad@ exitosamente.');

        return redirect(route('admin.categories.index'));
    }
}