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
use Illuminate\Support\Facades\Log;

/**
 * Class AddressController
 * @package App\Http\Controllers\API
 */

class AddressAPIController extends \App\Http\Controllers\Controller
{
    /** @var  AddressRepository */
    private $addressRepository;

    public function __construct(AddressRepository $addressRepo)
    {
        $this->addressRepository = $addressRepo;
    }

    public function index(Request $request)
    {
        $addresses = QueryBuilder::for(Address::class)
            // ->allowedIncludes('categories', 'store', 'questions')
            ->allowedFilters('is_paying', 'is_collecting', 'is_primary', 'is_shipping', 'is_billing')
            // ->defaultSort('created_at')
            // ->allowedSorts('name', 'created_at')
            // ->allowedAppends('final_price')
            ->where('addressable_type', 'App\User')
            ->where('addressable_id', auth('api')->user()->id)
            ->get();

        return $addresses;
    }

    public function store(Request $request)
    {
        $user = auth('api')->user();
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
        if (isset($input['is_shipping']) && $input['is_shipping'] == true) {
            $type = 'is_shipping';
            $input['given_name'] = $user->first_name;
            $input['family_name'] = $user->last_name;
        }
        if (isset($input['is_billing']) && $input['is_billing'] == true) {
            $type = 'is_billing';
            if (isset($input['skip_document']) && $input['skip_document'] == true) {
                $input['document_number'] = null;
            }
        }
        if (isset($input['is_primary']) && $input['is_primary'] == true) {
            Address::cleanPrimaryAddresses($user->addresses->where($type, true));
        }

        // * Save Ubigeo Fields ONLY SHIPPING
        if ($type == 'is_shipping' && isset($input['district'])) {
            $ubigeo_id = Ubigeo::where('state', $input['state'])
                ->where('city', $input['city'])
                ->where('district', $input['district'])
                ->first()->id ?? null;


            if (!isset($ubigeo_id)) {
                return $this->sendError('Ubigeo no encontrado');
            }
            $input['ubigeo_id'] = $ubigeo_id;
        }

        $address = $user->addresses()->create($input);
        return $address->toArray();
    }

    public function show($id)
    {
        /** @var Address $address */
        $address = $this->addressRepository->findWithoutFail($id);

        if (empty($address)) {
            return $this->sendError('Dirección no encontrada');
        }

        return $address;
    }

    public function update($id, Request $request)
    {
        $input = $request->all();
        $address = $this->addressRepository->findWithoutFail($id);

        if (empty($address)) {
            return $this->sendError('Dirección no encontrada');
        }

        if ($address->addressable_id != auth('api')->user()->id) {
            return $this->sendError('Not allowed to update other user address');
        }

        $user = auth('api')->user();
        if (isset($input['is_shipping']) && $input['is_shipping'] == true) {
            $type = 'is_shipping';
            $input['given_name'] = $user->first_name;
            $input['family_name'] = $user->last_name;
        }
        if (isset($input['is_billing']) && $input['is_billing'] == true) {
            $type = 'is_billing';
            if (isset($input['skip_document']) && $input['skip_document'] == true) {
                $input['document_number'] = null;
                $input['given_name'] = $user->first_name;
                $input['family_name'] = $user->last_name;
            }
        }


        if (isset($input['is_primary']) && $input['is_primary'] == true) {
            Address::cleanPrimaryAddresses(auth('api')->user()->addresses->where($type, true));
        }

        if ($type == 'is_shipping' && isset($input['district'])) {

            $ubigeo_id = Ubigeo::where('state', $input['state'])
                ->where('city', $input['city'])
                ->where('district', $input['district'])
                ->first()->id ?? null;

            $input['ubigeo_id'] = $ubigeo_id;
        }

        $address = $this->addressRepository->update($input, $id);
        return $address;
    }

    public function destroy($id)
    {
        /** @var Address $address */
        $address = $this->addressRepository->findWithoutFail($id);

        if (empty($address)) {
            return $this->sendError('Dirección no encontrada');
        }

        $address->delete();

        return $this->sendResponse($id, 'Dirección eliminada');
    }


    public function geocode(Request $request)
    {
        $address = $request->address;

        try {
            $response = \GoogleMaps::load('geocoding')
            ->setParamByKey('address', $address)
            // ->setParamByKey('components.administrative_area', 'TX')
                ->get();
        } catch (\Throwable $th) {
           \Log::error('Error de google maps');
           \Log::error($th);
           return $this->sendError('Error de GMaps geocode');
        }

        return ($response);  // output 
    }
}