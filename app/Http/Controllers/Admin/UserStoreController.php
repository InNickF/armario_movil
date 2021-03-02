<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\UserStoreDataTable;
use App\Http\Requests\Admin;
use App\Http\Requests\Admin\CreateUserStoreRequest;
use App\Http\Requests\Admin\UpdateUserStoreRequest;
use App\Repositories\Admin\UserStoreRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class UserStoreController extends \App\Http\Controllers\Controller
{
    /** @var  UserStoreRepository */
    private $userStoreRepository;

    public function __construct(UserStoreRepository $userStoreRepo)
    {
        $this->userStoreRepository = $userStoreRepo;
    }

    /**
     * Display a listing of the UserStore.
     *
     * @param UserStoreDataTable $userStoreDataTable
     * @return Response
     */
    public function index(UserStoreDataTable $userStoreDataTable)
    {
        return $userStoreDataTable->render('admin.user_stores.index');
    }


    /**
     * Show the form for editing the specified UserStore.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $userStore = $this->userStoreRepository->findWithoutFail($id);

        if (empty($userStore)) {
            alert()->error('Tienda no encontrada');

            return redirect(route('admin.stores.index'));
        }

        return view('admin.user_stores.edit')->with('userStore', $userStore);
    }

    /**
     * Update the specified UserStore in storage.
     *
     * @param  int              $id
     * @param UpdateUserStoreRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateUserStoreRequest $request)
    {
        $userStore = $this->userStoreRepository->findWithoutFail($id);

        if (empty($userStore)) {
            alert()->error('Tienda no encontrada');

            return redirect(route('admin.stores.index'));
        }

        $userStore = $this->userStoreRepository->update($request->all(), $id);

        alert()->success('Tienda actualizada');

        return back();
    }

    /**
     * Remove the specified UserStore from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $userStore = $this->userStoreRepository->findWithoutFail($id);

        if (empty($userStore)) {
            alert()->error('Tienda no encontrada');

            return redirect(route('admin.stores.index'));
        }

        $this->userStoreRepository->delete($id);

        alert()->success('Tienda eliminada');

        return redirect(route('admin.stores.index'));
    }
}