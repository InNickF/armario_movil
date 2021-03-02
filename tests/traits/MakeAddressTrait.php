<?php

use Faker\Factory as Faker;
use App\Models\Address;
use App\Repositories\AddressRepository;

trait MakeAddressTrait
{
    /**
     * Create fake instance of Address and save it in database
     *
     * @param array $addressFields
     * @return Address
     */
    public function makeAddress($addressFields = [])
    {
        /** @var AddressRepository $addressRepo */
        $addressRepo = App::make(AddressRepository::class);
        $theme = $this->fakeAddressData($addressFields);
        return $addressRepo->create($theme);
    }

    /**
     * Get fake instance of Address
     *
     * @param array $addressFields
     * @return Address
     */
    public function fakeAddress($addressFields = [])
    {
        return new Address($this->fakeAddressData($addressFields));
    }

    /**
     * Get fake data of Address
     *
     * @param array $postFields
     * @return array
     */
    public function fakeAddressData($addressFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'addressable_type' => $fake->word,
            'addressable_id' => $fake->word,
            'given_name' => $fake->word,
            'family_name' => $fake->word,
            'label' => $fake->word,
            'organization' => $fake->word,
            'country_code' => $fake->word,
            'street' => $fake->word,
            'state' => $fake->word,
            'city' => $fake->word,
            'postal_code' => $fake->word,
            'latitude' => $fake->word,
            'longitude' => $fake->word,
            'is_primary' => $fake->word,
            'is_billing' => $fake->word,
            'is_shipping' => $fake->word,
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s'),
            'deleted_at' => $fake->date('Y-m-d H:i:s')
        ], $addressFields);
    }
}
