<?php

namespace App\Http\Controllers\Account;

use App\Helpers\JsonHelper;
use App\Http\Controllers\AppBaseController;
use App\Http\Requests\UpdateUserRequest;
use App\Repositories\UserRepository;
use App\Services\DaysService;
use App\Services\HoursService;
use App\Ubigeo;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Response;
use Silber\Bouncer\Database\Role;
// use Alert;

class UserController extends \App\Http\Controllers\Controller
{
	/** @var UserRepository */
	private $userRepository;

	public function __construct(UserRepository $userRepo)
	{
		$this->userRepository = $userRepo;
	}

	public function profile()
	{
		$user = Auth::user();
		// dd($user);

		if (empty($user)) {
			alert()->error('Usuario no encontrado');

			return redirect(url('/'));
		}

		$roles = Role::all();
		$roles = array_pluck($roles, 'title', 'name');
		$days = DaysService::getDays();
		$hours = HoursService::createTimeRange('0:00', '23:30', '30 mins', '24');

		$states = Ubigeo::all()->groupBy('state');

		return view('account.users.profile')
			->with('user', $user)
			->with('title', 'Mi perfil')
			->with('roles', $roles)
			->with(compact('states'))
			->with(compact('hours'))
			->with(compact('days'));
	}

	public function update(UpdateUserRequest $request)
	{
		$user = Auth::user();
		if (empty($user)) {
			alert()->error('User no encontrad@');

			return redirect(route('account.users.index'));
		}
		$input = $request->all();

		$images = $user->getAllMedia();
		if (isset($input['avatar_image'])) {
			$avatarImage = JsonHelper::jsonOrEmpty($request->get('avatar_image'));
			if (!isset($avatarImage['manuallyAdded']) || !$avatarImage['manuallyAdded']) {
				// dd($avatarImage);
				foreach ($images as $key => $image) {
					if ($image->hasCustomProperty('isAvatar')) {
						$image->delete();
					}
				}
				$user->saveAvatarImage($avatarImage['path']);
			}
		}
		$input['dob'] = Carbon::parse($input['dob']);
		// dd($input);
		$user = $this->userRepository->update($input, $user->id);

		alert()->success('Perfil actualizado');

		return $request->has('redirect') ? redirect(url($request->get('redirect'))) : back();
	}

	public function passwordEdit()
	{
		$user = Auth::user();

		if (empty($user)) {
			alert()->error('No se encontró al usuario');

			return back();
		}

		return view('account.users.password')->with('user', $user)->with('title', 'Mi perfil');
	}

	public function passwordUpdate(Request $request)
	{
		$user = Auth::user();
		if (empty($user)) {
			alert()->error('No se encontró al usuario');

			return back();
		}

		$input = $request->input();

		if (!Hash::check($input['old_password'], $user->password)) {
			alert()->error('La contraseña actual ingresada es incorrecta');

			return back();
		}

		$validator = Validator::make($request->all(), [
			'password' => ['required', 'string', 'min:8', 'confirmed'],
			'old_password' => ['required', 'string', 'min:6'],
		]);

		if ($validator->fails()) {
			alert()->error('No se pudo actualizar la contraseña, asegúrate de que la contraseña de ambos campos coincidan');

			return back();
		}

		$input['password'] = Hash::make($input['password']);

		$user = $this->userRepository->update($input, $user->id);

		alert()->success('Contraseña actualizada');

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

		if (empty($user)) { }

		if ($id != Auth::user()->id) {
			alert()->error('No puedes borrar la cuenta de otro usuario');

			return back();
		}

		$this->userRepository->delete($id);

		alert()->success('Usuario eliminado');

		return redirect('/');
	}

	public function passport()
	{
		return view('account.users.passport');
	}

	public function transactions()
	{
		$transactions = auth()->user()->transactions()->latest();

		$startFilter =  request()->get('start') ? Carbon::parse(request()->get('start'))->startOfDay()->format('Y/m/d') : null;
		$endFilter = request()->get('end') ? Carbon::parse(request()->get('end'))->endOfDay()->format('Y/m/d') : null;


		if ($startFilter) {
			$transactions->whereDate('created_at', '>=', $startFilter);
		}
		if ($endFilter) {
			$transactions->whereDate('created_at', '<=', $endFilter);
		}

		$transactions = $transactions->paginate(20);

		return view('account.users.transactions.index', compact('transactions', 'startFilter', 'endFilter'));
	}

	public function payment()
	{
		$user = User::with('payment_methods', 'collecting_method')->find(auth()->user()->id);
		$tab = 'paying';
		// dd($user->collecting_method());
		return view('account.users.payment.index', compact('user', 'tab'));
	}


	public function updateCollectingMethod(Request $request)
	{

		try {
			$user = auth()->user();

			$input = $request->all();
			$input['is_collecting'] = true;
			$input['is_paying'] = false;
			$input['is_card'] = false;
			$input['is_primary'] = true;
			// dd($input);

			if (!$user->collecting_method) {
				$user->collecting_method()->create($input);
			} else {
				// dd($input);
				$user->collecting_method->update($input);
			}
		} catch (\Throwable $th) {
			alert()->error('Ha ocurrido un error al actualizar tu forma de cobro');
		}

		alert()->success("Tu forma de cobro ha sido actualizada");

		$tab = 'collecting';

		return redirect(url('account/payment?tab=collecting'));
	}
}