<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class StoryApiTest extends TestCase
{
    use MakeStoryTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateStory()
    {
        $story = $this->fakeStoryData();
        $this->json('POST', '/api/v1/stories', $story);

        $this->assertApiResponse($story);
    }

    /**
     * @test
     */
    public function testReadStory()
    {
        $story = $this->makeStory();
        $this->json('GET', '/api/v1/stories/'.$story->id);

        $this->assertApiResponse($story->toArray());
    }

    /**
     * @test
     */
    public function testUpdateStory()
    {
        $story = $this->makeStory();
        $editedStory = $this->fakeStoryData();

        $this->json('PUT', '/api/v1/stories/'.$story->id, $editedStory);

        $this->assertApiResponse($editedStory);
    }

    /**
     * @test
     */
    public function testDeleteStory()
    {
        $story = $this->makeStory();
        $this->json('DELETE', '/api/v1/stories/'.$story->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/stories/'.$story->id);

        $this->assertResponseStatus(404);
    }
}
