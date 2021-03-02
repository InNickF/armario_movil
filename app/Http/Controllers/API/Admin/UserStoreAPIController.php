<?php

namespace App\Http\Controllers\API\Admin;

use App\Models\UserStore;


class UserStoreAPIController extends \App\Http\Controllers\Controller
{

    public function toggleIsOfficial($id)
    {
        $store = UserStore::find($id);

        if (empty($store)) {
            return $this->sendError('Tienda no encontrada');
        }

        $is_official = request('is_official');

        $store->is_official = $is_official;
        $store->save();

        return $this->sendResponse($store->toArray(), 'Store is_official flag changed successfully');
    }
}