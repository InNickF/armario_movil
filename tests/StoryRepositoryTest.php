<?php

use App\Models\Story;
use App\Repositories\StoryRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class StoryRepositoryTest extends TestCase
{
    use MakeStoryTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var StoryRepository
     */
    protected $storyRepo;

    public function setUp()
    {
        parent::setUp();
        $this->storyRepo = App::make(StoryRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateStory()
    {
        $story = $this->fakeStoryData();
        $createdStory = $this->storyRepo->create($story);
        $createdStory = $createdStory->toArray();
        $this->assertArrayHasKey('id', $createdStory);
        $this->assertNotNull($createdStory['id'], 'Created Story must have id specified');
        $this->assertNotNull(Story::find($createdStory['id']), 'Story with given id must be in DB');
        $this->assertModelData($story, $createdStory);
    }

    /**
     * @test read
     */
    public function testReadStory()
    {
        $story = $this->makeStory();
        $dbStory = $this->storyRepo->find($story->id);
        $dbStory = $dbStory->toArray();
        $this->assertModelData($story->toArray(), $dbStory);
    }

    /**
     * @test update
     */
    public function testUpdateStory()
    {
        $story = $this->makeStory();
        $fakeStory = $this->fakeStoryData();
        $updatedStory = $this->storyRepo->update($fakeStory, $story->id);
        $this->assertModelData($fakeStory, $updatedStory->toArray());
        $dbStory = $this->storyRepo->find($story->id);
        $this->assertModelData($fakeStory, $dbStory->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteStory()
    {
        $story = $this->makeStory();
        $resp = $this->storyRepo->delete($story->id);
        $this->assertTrue($resp);
        $this->assertNull(Story::find($story->id), 'Story should not exist in DB');
    }
}
