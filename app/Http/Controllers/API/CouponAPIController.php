<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateCouponAPIRequest;
use App\Http\Requests\API\UpdateCouponAPIRequest;
use App\Models\Coupon;
use App\Repositories\CouponRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class CouponController
 * @package App\Http\Controllers\API
 */

class CouponAPIController extends \App\Http\Controllers\Controller
{
    /** @var  CouponRepository */
    private $couponRepository;

    public function __construct(CouponRepository $couponRepo)
    {
        $this->couponRepository = $couponRepo;
    }

    public function show($code)
    {
        /** @var Coupon $coupon */
        $coupon = $this->couponRepository->findWhere(['code' => $code])->first();

        if (empty($coupon)) {
            return $this->sendError('Coupon no encontrad@');
        }

        return $this->sendResponse($coupon->toArray(), 'Coupon retrieved successfully');
    }

   
    public function update($id, UpdateCouponAPIRequest $request)
    {
        $input = $request->all();

        /** @var Coupon $coupon */
        $coupon = $this->couponRepository->findWithoutFail($id);

        if (empty($coupon)) {
            return $this->sendError('Coupon no encontrad@');
        }

        $coupon = $this->couponRepository->update($input, $id);

        return $this->sendResponse($coupon->toArray(), 'Coupon updated successfully');
    }

}
