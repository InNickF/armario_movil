<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateStoreAPIRequest;
use App\Http\Requests\API\UpdateStoreAPIRequest;
use App\Models\Store;
use App\Repositories\StoreRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use App\Criteria\NearCriteria;

/**
 * Class StoreController
 * @package App\Http\Controllers\API
 */

class StoreAPIController extends \App\Http\Controllers\Controller
{
    /** @var  StoreRepository */
    private $storeRepository;

    public function __construct(StoreRepository $storeRepo)
    {
        $this->storeRepository = $storeRepo;
    }

    public function index(Request $request)
    {
        $this->storeRepository->pushCriteria(new RequestCriteria($request));
        $this->storeRepository->pushCriteria(new LimitOffsetCriteria($request));

        if ($request->has('latitude') && $request->has('longitude')) {
            $this->storeRepository->pushCriteria(new NearCriteria($request->query('latitude'), $request->query('longitude')));
        }

        $stores = $this->storeRepository->all();
        return $this->sendResponse($stores->toArray(), 'Stores retrieved successfully');
    }

    public function store(CreateStoreAPIRequest $request)
    {
        $input = $request->all();

        $stores = $this->storeRepository->create($input);

        return $this->sendResponse($stores->toArray(), 'Store saved successfully');
    }


    public function show($id)
    {
        /** @var Store $store */
        $store = $this->storeRepository->findWithoutFail($id);

        if (empty($store)) {
            return $this->sendError('Store no encontrad@');
        }

        return $this->sendResponse($store->toArray(), 'Store retrieved successfully');
    }


    public function update($id, UpdateStoreAPIRequest $request)
    {
        $input = $request->all();

        /** @var Store $store */
        $store = $this->storeRepository->findWithoutFail($id);

        if (empty($store)) {
            return $this->sendError('Store no encontrad@');
        }

        $store = $this->storeRepository->update($input, $id);

        return $this->sendResponse($store->toArray(), 'Store updated successfully');
    }


    public function destroy($id)
    {
        /** @var Store $store */
        $store = $this->storeRepository->findWithoutFail($id);

        if (empty($store)) {
            return $this->sendError('Store no encontrad@');
        }

        $store->delete();

        return $this->sendResponse($id, 'Store ha sido eliminado');
    }
}
