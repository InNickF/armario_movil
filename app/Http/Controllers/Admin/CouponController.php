<?php

namespace App\Http\Controllers\Admin;

use Flash;

use Response;
use App\Models\Coupon;
use App\Models\Product;
use App\Models\UserStore;
use App\Repositories\CouponRepository;
use App\DataTables\Admin\CouponDataTable;
use App\Http\Requests\CreateCouponRequest;
use App\Http\Requests\UpdateCouponRequest;
use App\User;
use App\Models\Category;

class CouponController extends \App\Http\Controllers\Controller
{
    private $couponRepository;

    public function __construct(CouponRepository $couponRepo)
    {
        $this->couponRepository = $couponRepo;
    }



    public function index(CouponDataTable $couponDataTable)
    {
        return $couponDataTable->render('admin.coupons.index');
    }



    public function create()
    {
        $users = User::all();
        $stores = UserStore::all();
        $products = Product::all();
        $plans = app('rinvex.subscriptions.plan')->whereIn('slug', ['ropero', 'armario', 'closet'])->get();
        $categories = Category::where(function ($query) {
            $query->parents()->orWhereIn('parent_id', Category::parents()->get()->pluck('id'));
        })->get()->sortBy('name_with_parent');

        return view('admin.coupons.create', compact('products', 'plans', 'stores', 'users', 'categories'));
    }



    public function store(CreateCouponRequest $request)
    {

        $input = $request->all();

        $coupon = $this->couponRepository->create($input);

        alert()->success('Cupón creado');

        return redirect(route('admin.coupons.index'));
    }



    public function edit($id)
    {
        $coupon = Coupon::with('products', 'plans', 'categories', 'users', 'stores')->find($id);
        if (empty($coupon)) {
            alert()->error('Cupón no encontrado');

            return redirect(route('admin.coupons.index'));
        }
        // dd($coupon);

        $users = User::all();
        $stores = UserStore::all();
        $products = Product::all();
        $plans = app('rinvex.subscriptions.plan')->whereIn('slug', ['ropero', 'armario', 'closet'])->get();
        $categories = Category::where(function ($query) {
            $query->parents()->orWhereIn('parent_id', Category::parents()->get()->pluck('id'));
        })->get()->sortBy('name_with_parent');

        return view('admin.coupons.edit', compact('coupon', 'products', 'plans', 'stores', 'users', 'categories'));
    }


    public function update($id, UpdateCouponRequest $request)
    {
        $coupon = $this->couponRepository->findWithoutFail($id);

        if (empty($coupon)) {
            alert()->error('Cupón no encontrado');

            return redirect(route('admin.coupons.index'));
        }

        $existingCode = Coupon::where('code', $request->code)->where('id', '!=', $id)->first();

        if (!empty($existingCode)) {
            alert()->error('El código ya existe, no se pudo guardar');

            return redirect(route('admin.coupons.index'));
        }

        $input = $request->all();

        if (!isset($input['users']) || empty($input['users'])) {
            $coupon->users()->detach();
        }
        if (!isset($input['products']) || empty($input['products'])) {
            $coupon->products()->detach();
        }
        if (!isset($input['stores']) || empty($input['stores'])) {
            $coupon->stores()->detach();
        }
        if (!isset($input['plans']) || empty($input['plans'])) {
            $coupon->plans()->detach();
        }


        if (!isset($input['categories']) || empty($input['categories'])) {
            $coupon->categories()->detach();
        }
        // dd($input);

        $coupon = $this->couponRepository->update($request->all(), $id);

        alert()->success('Cupón actualizado.');

        return back();
    }

    /**
     * Remove the specified Cupón from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $coupon = $this->couponRepository->findWithoutFail($id);

        if (empty($coupon)) {
            alert()->error('Cupón no encontrado');

            return redirect(route('admin.coupons.index'));
        }

        $this->couponRepository->delete($id);

        alert()->success('Cupón eliminado');

        return redirect(route('admin.coupons.index'));
    }
}