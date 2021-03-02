<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\SliderDataTable;
use App\Http\Requests\Admin\CreateSliderRequest;
use App\Http\Requests\Admin\UpdateSliderRequest;
use App\Models\Category;
use App\Repositories\Admin\SliderRepository;
use Response;

class SliderController extends \App\Http\Controllers\Controller
{
    /** @var  SliderRepository */
    private $sliderRepository;

    public function __construct(SliderRepository $sliderRepo)
    {
        $this->sliderRepository = $sliderRepo;
    }

    /**
     * Display a listing of the Slider.
     *
     * @param SliderDataTable $sliderDataTable
     * @return Response
     */
    public function index(SliderDataTable $sliderDataTable)
    {

        return $sliderDataTable->render('admin.sliders.index');
    }

    /**
     * Show the form for creating a new Slider.
     *
     * @return Response
     */
    public function create()
    {
        
        $categories = Category::all();
        return view('admin.sliders.create', compact('categories'));
    }

    /**
     * Store a newly created Slider in storage.
     *
     * @param CreateSliderRequest $request
     *
     * @return Response
     */
    public function store(CreateSliderRequest $request)
    {
        $input = $request->all();
        
        $slider = $this->sliderRepository->create($input);
        
        alert()->success('Slider guardado');

        return redirect(route('admin.sliders.edit', $slider->id));
    }
    
    /**
     * Display the specified Slider.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $slider = $this->sliderRepository->findWithoutFail($id);
        
        if (empty($slider)) {
            alert()->error('Slider no encontrado');
            
            return redirect(route('admin.sliders.index'));
        }
        
        return view('admin.sliders.show')->with('slider', $slider);
    }

    /**
     * Show the form for editing the specified Slider.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $slider = $this->sliderRepository->findWithoutFail($id);
        
        if (empty($slider)) {
            alert()->error('Slider no encontrado');
            
            return redirect(route('admin.sliders.index'));
        }
        
        $categories = Category::all();
        return view('admin.sliders.edit', compact('slider', 'categories'));
    }
    
    /**
     * Update the specified Slider in storage.
     *
     * @param  int              $id
     * @param UpdateSliderRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateSliderRequest $request)
    {
        $slider = $this->sliderRepository->findWithoutFail($id);

        if (empty($slider)) {
            alert()->error('Slider no encontrado');

            return redirect(route('admin.sliders.index'));
        }

        $slider = $this->sliderRepository->update($request->all(), $id);

        alert()->success('Slider actualizado');

        return back();
    }

    /**
     * Remove the specified Slider from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $slider = $this->sliderRepository->findWithoutFail($id);

        if (empty($slider)) {
            alert()->error('Slider no encontrado');

            return redirect(route('admin.sliders.index'));
        }

        $this->sliderRepository->delete($id);

        alert()->success('Slider eliminado');

        return redirect(route('admin.sliders.index'));
    }
}
