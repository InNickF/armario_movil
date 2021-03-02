<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateStoryAPIRequest;
use App\Http\Requests\API\UpdateStoryAPIRequest;
use App\Models\Story;
use App\Repositories\StoryRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class StoryController
 * @package App\Http\Controllers\API
 */

class StoryAPIController extends \App\Http\Controllers\Controller
{
    /** @var  StoryRepository */
    private $storyRepository;

    public function __construct(StoryRepository $storyRepo)
    {
        $this->storyRepository = $storyRepo;
    }

    /**
     * Display a listing of the Story.
     * GET|HEAD /stories
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->storyRepository->pushCriteria(new RequestCriteria($request));
        $this->storyRepository->pushCriteria(new LimitOffsetCriteria($request));
        $stories = $this->storyRepository->findWhere(['is_active' => true]);

        return $this->sendResponse($stories->toArray(), 'Stories retrieved successfully');
    }

    /**
     * Store a newly created Story in storage.
     * POST /stories
     *
     * @param CreateStoryAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateStoryAPIRequest $request)
    {
        $input = $request->all();
        $image = request('image');

        $storeId = auth('api')->user()->store->id;
        if (!$storeId) {
            return $this->sendError('El ID de tienda es obligatorio');
        }

        $input['store_id'] = $storeId;

        if (!$image) {
            return $this->sendError('La imagen es obligatoria');
        }

        $story = $this->storyRepository->create($input);
        $story->saveImage($image);

        return $this->sendResponse($story->toArray(), 'Historia creada exitosamente');
    }

    /**
     * Display the specified Story.
     * GET|HEAD /stories/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Story $story */
        $story = $this->storyRepository->findWithoutFail($id);

        if (empty($story)) {
            return $this->sendError('Story not found');
        }

        return $this->sendResponse($story->toArray(), 'Story retrieved successfully');
    }

    /**
     * Update the specified Story in storage.
     * PUT/PATCH /stories/{id}
     *
     * @param  int $id
     * @param UpdateStoryAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateStoryAPIRequest $request)
    {
        $input = $request->all();

        /** @var Story $story */
        $story = $this->storyRepository->findWithoutFail($id);

        if (empty($story)) {
            return $this->sendError('Story not found');
        }

        $story = $this->storyRepository->update($input, $id);

        return $this->sendResponse($story->toArray(), 'Story updated successfully');
    }

    public function click($id)
    {

        $story = $this->storyRepository->findWithoutFail($id);

        if (empty($story)) {
            return $this->sendError('Story not found');
        }

        $story->clicks += 1;
        $story->save();

        return $this->sendResponse($story->toArray(), 'Story clicks updated successfully');
    }

    /**
     * Remove the specified Story from storage.
     * DELETE /stories/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Story $story */
        $story = $this->storyRepository->findWithoutFail($id);

        if (empty($story)) {
            return $this->sendError('Story not found');
        }

        $story->delete();

        return $this->sendResponse($id, 'Story ha sido eliminado');
    }
}