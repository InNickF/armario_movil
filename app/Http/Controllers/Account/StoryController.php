<?php

namespace App\Http\Controllers\Account;

use App\DataTables\Admin\StoryDataTable;
use App\Http\Requests\Admin;
use App\Http\Requests\Admin\CreateStoryRequest;
use App\Http\Requests\Admin\UpdateStoryRequest;
use App\Repositories\Admin\StoryRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;
use App\Models\Story;

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
    public function index()
    {   
        $stories = auth()->user()->store->stories()->latest()->paginate(10);
        return view('account.stories.index', compact('stories'));
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
            alert()->error('Historia no encontrada');

            return redirect(route('account.stories.index'));
        }

        $this->storyRepository->delete($id);

        alert()->success('Se ha eliminado la historia');

        return redirect(route('account.stories.index'));
    }
}
