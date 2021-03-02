<?php

namespace App\Http\Controllers\API;

use Response;
use App\Ubigeo;
use App\Models\Address;
use GoogleMaps\GoogleMaps;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\QueryBuilder\QueryBuilder;
use App\Repositories\AddressRepository;
use App\Http\Controllers\AppBaseController;


class PaymentMethodAPIController extends \App\Http\Controllers\Controller
{


    public function store(Request $request)
    {
        $user = Auth::user();
        $input = $request->all();
        // $input = [
        //     'label' => 'Default Address',
        //     'given_name' => 'Abdelrahman',
        //     'family_name' => 'Omran',
        //     'organization' => 'Rinvex',
        //     'country_code' => 'eg',
        //     'street' => '56 john doe st.',
        //     'state' => 'Alexandria',
        //     'city' => 'Alexandria',
        //     'postal_code' => '21614',
        //     'latitude' => '31.2467601',
        //     'longitude' => '29.9020376',
        //     'is_primary' => true,
        //     'is_billing' => true,
        //     'is_shipping' => true,
        // ];
        if (isset($input['is_primary']) && $input['is_primary'] == true) {
            if (isset($input['is_shipping']) && $input['is_shipping'] == true) {
                $type = 'is_shipping';
            }
            if (isset($input['is_billing']) && $input['is_billing'] == true) {
                $type = 'is_billing';
            }
            Address::cleanPrimaryAddresses($user->addresses->where($type, true));
        }

        $input['given_name'] = $user->first_name;
        $input['family_name'] = $user->last_name;


        $ubigeo_id = Ubigeo::where('state', $input['state'])
            ->where('city', $input['city'])
            ->where('district', $input['district'])
            ->first()->id ?? null;

        if (!$ubigeo_id) {
            return $this->sendError('Ubigeo no encontrad@');
        }

        // var_dump($ubigeo_id);

        $input['ubigeo_id'] = $ubigeo_id;

        $address = $user->addresses()->create($input);
        // var_dump($address);
        return $address->toArray();
    }


    public function update($id, Request $request)
    {
        $input = $request->all();
        $address = $this->addressRepository->findWithoutFail($id);

        if (empty($address)) {
            return $this->sendError('Address no encontrad@');
        }

        if ($address->addressable_id != Auth::user()->id) {
            return $this->sendError('Not allowed to update other user address');
        }

        if (isset($input['is_primary']) && $input['is_primary'] == true) {
            if (isset($input['is_shipping']) && $input['is_shipping'] == true) {
                $type = 'is_shipping';
            }
            if (isset($input['is_billing']) && $input['is_billing'] == true) {
                $type = 'is_billing';
            }
            Address::cleanPrimaryAddresses(Auth::user()->addresses->where($type, true));
        }

        $user = Auth::user();
        $input['given_name'] = $user->first_name;
        $input['family_name'] = $user->last_name;

        $ubigeo_id =  Ubigeo::where('state', $address->state)
            ->where('city', $address->city)
            ->where('district', $address->district)
            ->first()->id ?? null;

        $address->ubigeo_id = $ubigeo_id;

        $address = $this->addressRepository->update($input, $id);

        return $address;
    }

    public function destroy($id)
    {
        /** @var Address $address */
        $address = $this->addressRepository->findWithoutFail($id);

        if (empty($address)) {
            return $this->sendError('Address no encontrad@');
        }

        $address->delete();

        return $this->sendResponse($id, 'Address ha sido eliminado');
    }
}
