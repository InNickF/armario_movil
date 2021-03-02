<?php

namespace App\Http\Controllers\Admin;

use Flash;
use Response;
use Carbon\Carbon;
use App\Models\Store;
use App\Models\Category;
use App\Models\UserStore;
use App\Helpers\JsonHelper;
use App\Http\Requests\Admin;
use function GuzzleHttp\json_decode;
use App\DataTables\Admin\ProductDataTable;
use App\Http\Controllers\AppBaseController;
use App\Repositories\Admin\ProductRepository;
use App\Http\Requests\Admin\CreateProductRequest;
use App\Http\Requests\Admin\UpdateProductRequest;

class ProductController extends \App\Http\Controllers\Controller
{
    /** @var  ProductRepository */
    private $productRepository;

    public function __construct(ProductRepository $productRepo)
    {
        $this->productRepository = $productRepo;
    }

    /**
     * Display a listing of the Product.
     *
     * @param ProductDataTable $productDataTable
     * @return Response
     */
    public function index(ProductDataTable $productDataTable)
    {

        $startFilter =  request('start_at') ? Carbon::parse(request('start_at'))->startOfDay()->format('Y/m/d') : null;
        $endFilter = request('end_at') ? Carbon::parse(request('end_at'))->endOfDay()->format('Y/m/d') : null;


        return $productDataTable->render('admin.products.index', compact('startFilter', 'endFilter'));
    }


    public function destroy($id)
    {
        $product = $this->productRepository->findWithoutFail($id);

        if (empty($product)) {
            alert()->error('Producto no encontrado');

            return redirect(url('admin/products'));
        }

        $this->productRepository->delete($id);

        alert()->success('Producto eliminado');

        return redirect(url('admin/products'));
    }
}
