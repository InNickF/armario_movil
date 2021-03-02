<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateCategoryAPIRequest;
use App\Http\Requests\API\UpdateCategoryAPIRequest;
use App\Models\Category;
use App\Repositories\CategoryRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class CategoryController
 * @package App\Http\Controllers\API
 */

class CategoryAPIController extends \App\Http\Controllers\Controller
{
    /** @var  CategoryRepository */
    private $categoryRepository;

    public function __construct(CategoryRepository $categoryRepo)
    {
        $this->categoryRepository = $categoryRepo;
    }

    public function index(Request $request)
    {
        $this->categoryRepository->pushCriteria(new RequestCriteria($request));
        $this->categoryRepository->pushCriteria(new LimitOffsetCriteria($request));
        $categories = $this->categoryRepository->all();
        
        return $this->sendResponse($categories->toArray(), 'Categories retrieved successfully');
    }

}
