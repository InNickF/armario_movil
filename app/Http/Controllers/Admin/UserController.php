<?php

namespace App\Http\Controllers\Admin;

use Flash;
use App\User;
use Response;
use App\Models\UserStore;
use App\DataTables\Admin\UserDataTable;
use App\Repositories\Admin\UserRepository;
use App\Http\Controllers\AppBaseController;
use App\DataTables\Scopes\UsersFollowingStore;
use App\Http\Requests\Admin\CreateUserRequest;
use App\Http\Requests\Admin\UpdateUserRequest;
use Silber\Bouncer\Database\Role;

class UserController extends \App\Http\Controllers\Controller
{
    /** @var UserRepository */
    private $userRepository;

    public function __construct(UserRepository $userRepo)
    {
        $this->userRepository = $userRepo;
    }

    /**
     * Display a listing of the User.
     *
     * @param UserDataTable $userDataTable
     *
     * @return Response
     */
    public function index(UserDataTable $userDataTable)
    {
        return $userDataTable->render('admin.users.index');
    }

    /**
     * Show the form for creating a new User.
     *
     * @return Response
     */
    public function create()
    {
        $roles = \Silber\Bouncer\Database\Role::all();

        return view('admin.users.create')->with('roles', $roles);
    }

    /**
     * Store a newly created User in storage.
     *
     * @param CreateUserRequest $request
     *
     * @return Response
     */
    public function store(CreateUserRequest $request)
    {
        $input = $request->all();

        $user = $this->userRepository->create($input);

        alert()->success('User saved successfully.');

        return redirect(route('users.index'));
    }

    /**
     * Display the specified User.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $user = $this->userRepository->findWithoutFail($id);

        if (empty($user)) {
            alert()->error('User no encontrad@');

            return redirect(route('users.index'));
        }

        return view('admin.users.show')->with('user', $user);
    }

    /**
     * Show the form for editing the specified User.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $user = $this->userRepository->findWithoutFail($id);
        $roles = \Silber\Bouncer\Database\Role::all();

        if (empty($user)) {
            alert()->error('User no encontrad@');

            return redirect(route('users.index'));
        }

        return view('admin.users.edit')->with('user', $user)->with('roles', $roles);
    }

    /**
     * Update the specified User in storage.
     *
     * @param int               $id
     * @param UpdateUserRequest $request
     *
     * @return Response
     */
    public function update($id)
    {
        $user = $this->userRepository->findWithoutFail($id);

        if (empty($user)) {
            alert()->error('User no encontrado');

            return redirect(route('users.index'));
        }

        if(request('role_name')) {
                if($user->getRoles() && count($user->getRoles())) {
                    foreach ($user->getRoles() as $key => $r) {
                       $user->retract($r);
                    }
                }
                $user->assign(request('role_name'));
            
        }

        $user = $this->userRepository->update(request()->all(), $id);

        alert()->success('User actualizado');

        return back();
    }

    /**
     * Remove the specified User from storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $user = $this->userRepository->findWithoutFail($id);

        if (empty($user)) {
            alert()->error('User no encontrad@');

            return redirect(route('users.index'));
        }

        $this->userRepository->delete($id);

        alert()->success('Usuario eliminado');

        return redirect(route('users.index'));
    }
}