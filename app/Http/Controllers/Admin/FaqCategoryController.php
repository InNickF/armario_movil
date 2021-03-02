<?php

namespace App\Http\Controllers\Admin;

use Flash;
use Response;
use App\Helpers\JsonHelper;
use App\Models\FaqCategory;
use App\Http\Requests\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\DataTables\Admin\FaqCategoryDataTable;
use App\Repositories\Admin\FaqCategoryRepository;
use App\Http\Requests\Admin\CreateFaqCategoryRequest;
use App\Http\Requests\Admin\UpdateFaqCategoryRequest;

class FaqCategoryController extends \App\Http\Controllers\Controller
{
    /** @var  FaqCategoryRepository */
    private $faqCategoryRepository;

    public function __construct(FaqCategoryRepository $faqCategoryRepo)
    {
        $this->faqCategoryRepository = $faqCategoryRepo;
    }

    /**
     * Display a listing of the FaqCategory.
     *
     * @param FaqCategoryDataTable $faqCategoryDataTable
     * @return Response
     */
    public function index()
    {
        $categories = FaqCategory::orderBy('order', 'asc')->renderAsArray();

        foreach ($categories as $key => &$category) {
            $category['link'] = route('admin.faqCategories.edit', $category['id']);
        }
        return view('admin.faq_categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new FaqCategory.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.faq_categories.create');
    }


    public function store(CreateFaqCategoryRequest $request)
    {
        $input = $request->all();
        $lastCategory = FaqCategory::orderBy('order', 'desc')->first() ? FaqCategory::orderBy('order', 'desc')->first()->order : 0;
        $input['order'] = $lastCategory + 1;
        $faqCategory = $this->faqCategoryRepository->create($input);

        if (isset($input['icon_image'])) {
            $iconImage = JsonHelper::jsonOrEmpty($input['icon_image']);
            if (!empty($iconImage)) {
                $faqCategory->saveIconImage($iconImage['path']);
            }
        }

        alert()->success('Faq Category saved successfully.');

        return redirect(route('admin.faqCategories.index'));
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
            $category = FaqCategory::find($categoryChanged->id);
            $category->parent_id = null;
            $category->order = $order;
            $category->save();
            if (!empty($categoryChanged->children)) {
                foreach ($categoryChanged->children as $categoryChangedChild) {
                    $categoryChild = FaqCategory::find($categoryChangedChild->id);
                    $categoryChild->parent_id = $category->id;
                    $category->order = $order;
                    $categoryChild->save();
                    $order ++;
                }
            }
            $order ++;
        }

        alert()->success('Categories actualizad@ exitosamente.');

        return redirect(route('admin.faqCategories.index'));
    }

    /**
     * Display the specified FaqCategory.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $faqCategory = $this->faqCategoryRepository->findWithoutFail($id);

        if (empty($faqCategory)) {
            alert()->error('Faq Category no encontrad@');

            return redirect(route('admin.faqCategories.index'));
        }

        return view('admin.faq_categories.show')->with('faqCategory', $faqCategory);
    }

    /**
     * Show the form for editing the specified FaqCategory.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $faqCategory = $this->faqCategoryRepository->findWithoutFail($id);

        if (empty($faqCategory)) {
            alert()->error('Faq Category no encontrad@');

            return redirect(route('admin.faqCategories.index'));
        }

        return view('admin.faq_categories.edit')->with('faqCategory', $faqCategory);
    }

    /**
     * Update the specified FaqCategory in storage.
     *
     * @param  int              $id
     * @param UpdateFaqCategoryRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateFaqCategoryRequest $request)
    {
        $faqCategory = $this->faqCategoryRepository->findWithoutFail($id);

        if (empty($faqCategory)) {
            alert()->error('Faq Category no encontrad@');

            return redirect(route('admin.faqCategories.index'));
        }

        $input = $request->all();
        $faqCategory = $this->faqCategoryRepository->update($input, $id);

        $images = $faqCategory->getAllMedia();
        if (isset($input['icon_image']) && !empty($input['icon_image']) && is_string($input['icon_image'])) {
            $iconImage = JsonHelper::jsonOrEmpty($input['icon_image']);
            if (!isset($iconImage['manuallyAdded']) || !$iconImage['manuallyAdded']) {
                foreach ($images as $key => $image) {
                    if ($image->hasCustomProperty('isIcon')) {
                        $image->delete();
                    }
                }
                
                $faqCategory->saveIconImage($iconImage['path']);
                // dd($iconImage);
            }
        }

        alert()->success('Faq Category actualizad@ exitosamente.');

        return back();
    }

    /**
     * Remove the specified FaqCategory from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $faqCategory = $this->faqCategoryRepository->findWithoutFail($id);

        if (empty($faqCategory)) {
            alert()->error('Faq Category no encontrad@');

            return redirect(route('admin.faqCategories.index'));
        }

        $this->faqCategoryRepository->delete($id);

        alert()->success('Faq Category eliminad@ exitosamente.');

        return redirect(route('admin.faqCategories.index'));
    }
}
