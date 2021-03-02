<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\AppBaseController;
use App\Models\UserStore;

class UserStoreAPIController extends \App\Http\Controllers\Controller
{

    public function index()
    {
        return UserStore::notOffline()->get();
    }

    public function gallery($id) {
        $data = UserStore::find($id)->gallery_images->paginate(9);
        return $this->sendResponse($data->toArray(), 'Fotos obtenidas');
    }
}
