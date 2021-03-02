<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\JsonHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CreateSlideRequest;
use App\Http\Requests\Admin\UpdateSlideRequest;
use App\Repositories\Admin\SlideRepository;
use Illuminate\Http\Request;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class SlideController extends Controller
{
    /** @var SlideRepository */
    private $slideRepository;

    public function __construct(SlideRepository $slideRepo)
    {
        $this->slideRepository = $slideRepo;
    }

    /**
     * Display a listing of the Slide.
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $this->slideRepository->pushCriteria(new RequestCriteria($request));
        $slides = $this->slideRepository->all();

        return view('admin.slides.index')
            ->with('slides', $slides)
        ;
    }

    /**
     * Show the form for creating a new Slide.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.slides.create');
    }

    /**
     * Store a newly created Slide in storage.
     *
     * @return Response
     */
    public function store(CreateSlideRequest $request)
    {
        $input = $request->all();

        $slide = $this->slideRepository->create($input);

        if (isset($input['image'])) {
            $mainImage = JsonHelper::jsonOrEmpty($input['image']);
            if (!empty($mainImage)) {
                $slide->saveImage($mainImage['path']);
            }
        }

        alert()->success('Diapositiva guardada');

        return redirect(route('admin.sliders.edit', $slide->slider_id));
    }

    /**
     * Display the specified Slide.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $slide = $this->slideRepository->findWithoutFail($id);

        if (empty($slide)) {
            alert()->error('Diapositiva no encontrada');

            return back();
        }

        return view('admin.slides.show')->with('slide', $slide);
    }

    /**
     * Show the form for editing the specified Slide.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $slide = $this->slideRepository->findWithoutFail($id);

        if (empty($slide)) {
            alert()->error('Diapositiva no encontrada');

            return back();
        }

        return view('admin.slides.edit')->with('slide', $slide);
    }

    /**
     * Update the specified Slide in storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function update($id, UpdateSlideRequest $request)
    {
        $slide = $this->slideRepository->findWithoutFail($id);

        if (empty($slide)) {
            alert()->error('Diapositiva no encontrada');

            return back();
        }

        $slide = $this->slideRepository->update($request->all(), $id);

        $input = request()->all();
        $images = $slide->media;

        if (isset($input['image'])) {
            $mainImage = JsonHelper::jsonOrEmpty($input['image']);

            if (!isset($mainImage['manuallyAdded']) || !$mainImage['manuallyAdded']) {
                foreach ($images as $key => $image) {
                    $image->delete();
                }

                // dd($mainImage);
                $slide->saveImage($mainImage['path']);
            }
        }

        alert()->success('Diapositiva actualizada');

        return redirect(route('admin.sliders.edit', $slide->slider_id));
    }

    /**
     * Remove the specified Slide from storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $slide = $this->slideRepository->findWithoutFail($id);

        if (empty($slide)) {
            alert()->error('Diapositiva no encontrada');

            return back();
        }

        $this->slideRepository->delete($id);

        alert()->success('Diapositiva eliminada.');

        return back();
    }
}