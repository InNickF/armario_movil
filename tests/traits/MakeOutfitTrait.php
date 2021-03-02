<?php

use Faker\Factory as Faker;
use App\Models\Outfit;
use App\Repositories\OutfitRepository;

trait MakeOutfitTrait
{
    /**
     * Create fake instance of Outfit and save it in database
     *
     * @param array $outfitFields
     * @return Outfit
     */
    public function makeOutfit($outfitFields = [])
    {
        /** @var OutfitRepository $outfitRepo */
        $outfitRepo = App::make(OutfitRepository::class);
        $theme = $this->fakeOutfitData($outfitFields);
        return $outfitRepo->create($theme);
    }

    /**
     * Get fake instance of Outfit
     *
     * @param array $outfitFields
     * @return Outfit
     */
    public function fakeOutfit($outfitFields = [])
    {
        return new Outfit($this->fakeOutfitData($outfitFields));
    }

    /**
     * Get fake data of Outfit
     *
     * @param array $postFields
     * @return array
     */
    public function fakeOutfitData($outfitFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'store_id' => $fake->randomDigitNotNull,
            'name' => $fake->word,
            'slug' => $fake->word,
            'description' => $fake->text,
            'is_active' => $fake->word,
            'category_id' => $fake->randomDigitNotNull,
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s')
        ], $outfitFields);
    }
}
