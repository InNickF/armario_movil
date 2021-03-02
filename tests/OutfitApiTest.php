<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class OutfitApiTest extends TestCase
{
    use MakeOutfitTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateOutfit()
    {
        $outfit = $this->fakeOutfitData();
        $this->json('POST', '/api/v1/outfits', $outfit);

        $this->assertApiResponse($outfit);
    }

    /**
     * @test
     */
    public function testReadOutfit()
    {
        $outfit = $this->makeOutfit();
        $this->json('GET', '/api/v1/outfits/'.$outfit->id);

        $this->assertApiResponse($outfit->toArray());
    }

    /**
     * @test
     */
    public function testUpdateOutfit()
    {
        $outfit = $this->makeOutfit();
        $editedOutfit = $this->fakeOutfitData();

        $this->json('PUT', '/api/v1/outfits/'.$outfit->id, $editedOutfit);

        $this->assertApiResponse($editedOutfit);
    }

    /**
     * @test
     */
    public function testDeleteOutfit()
    {
        $outfit = $this->makeOutfit();
        $this->json('DELETE', '/api/v1/outfits/'.$outfit->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/outfits/'.$outfit->id);

        $this->assertResponseStatus(404);
    }
}
