<?php

use Faker\Factory as Faker;
use App\Models\Store;
use App\Repositories\StoreRepository;

trait MakeStoreTrait
{
    /**
     * Create fake instance of Store and save it in database
     *
     * @param array $storeFields
     * @return Store
     */
    public function makeStore($storeFields = [])
    {
        /** @var StoreRepository $storeRepo */
        $storeRepo = App::make(StoreRepository::class);
        $theme = $this->fakeStoreData($storeFields);
        return $storeRepo->create($theme);
    }

    /**
     * Get fake instance of Store
     *
     * @param array $storeFields
     * @return Store
     */
    public function fakeStore($storeFields = [])
    {
        return new Store($this->fakeStoreData($storeFields));
    }

    /**
     * Get fake data of Store
     *
     * @param array $postFields
     * @return array
     */
    public function fakeStoreData($storeFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'name' => $fake->word,
            'description' => $fake->text,
            'email' => $fake->word,
            'logo_image' => $fake->word,
            'latitude' => $fake->randomDigitNotNull,
            'longitude' => $fake->randomDigitNotNull,
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s')
        ], $storeFields);
    }
}
