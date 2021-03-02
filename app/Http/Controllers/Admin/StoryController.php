<?php

namespace App\Http\Controllers\Admin;

use Flash;
use Response;
use Carbon\Carbon;
use App\Http\Requests\Admin;
use App\DataTables\Admin\StoryDataTable;
use App\Http\Controllers\AppBaseController;
use App\Repositories\Admin\StoryRepository;
use App\Http\Requests\Admin\CreateStoryRequest;
use App\Http\Requests\Admin\UpdateStoryRequest;

class StoryController extends \App\Http\Controllers\Controller
{
    /** @var  StoryRepository */
    private $storyRepository;

    public function __construct(StoryRepository $storyRepo)
    {
        $this->storyRepository = $storyRepo;
    }

    /**
     * Display a listing of the Story.
     *
     * @param StoryDataTable $storyDataTable
     * @return Response
     */
    public function index(StoryDataTable $storyDataTable)
    {

        $startFilter =  request('start_at') ? Carbon::parse(request('start_at'))->startOfDay()->format('Y/m/d') : null;
        $endFilter = request('end_at') ? Carbon::parse(request('end_at'))->endOfDay()->format('Y/m/d') : null;
        return $storyDataTable->render('admin.stories.index', compact('startFilter', 'endFilter'));
    }

    /**
     * Show the form for creating a new Story.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.stories.create');
    }

    /**
     * Store a newly created Story in storage.
     *
     * @param CreateStoryRequest $request
     *
     * @return Response
     */
    public function store(CreateStoryRequest $request)
    {
        $input = $request->all();

        $story = $this->storyRepository->create($input);

        alert()->success('Story saved successfully.');

        return redirect(route('admin.stories.index'));
    }

    /**
     * Display the specified Story.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $story = $this->storyRepository->findWithoutFail($id);

        if (empty($story)) {
            alert()->error('Story not found');

            return redirect(route('admin.stories.index'));
        }

        return view('admin.stories.show')->with('story', $story);
    }

    /**
     * Show the form for editing the specified Story.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $story = $this->storyRepository->findWithoutFail($id);

        if (empty($story)) {
            alert()->error('Story not found');

            return redirect(route('admin.stories.index'));
        }

        return view('admin.stories.edit')->with('story', $story);
    }

    /**
     * Update the specified Story in storage.
     *
     * @param  int              $id
     * @param UpdateStoryRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateStoryRequest $request)
    {
        $story = $this->storyRepository->findWithoutFail($id);

        if (empty($story)) {
            alert()->error('Story not found');

            return redirect(route('admin.stories.index'));
        }

        $story = $this->storyRepository->update($request->all(), $id);

        alert()->success('Story updated successfully.');

        return back();
    }

    /**
     * Remove the specified Story from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $story = $this->storyRepository->findWithoutFail($id);

        if (empty($story)) {
            alert()->error('Story not found');

            return redirect(route('admin.stories.index'));
        }

        $this->storyRepository->delete($id);

        alert()->success('Story ha sido eliminado');

        return redirect(route('admin.stories.index'));
    }
}