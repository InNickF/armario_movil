<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\TestimonialDataTable;
use App\Http\Requests\Admin;
use App\Http\Requests\Admin\CreateTestimonialRequest;
use App\Http\Requests\Admin\UpdateTestimonialRequest;
use App\Repositories\Admin\TestimonialRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use App\User;
use Response;

class TestimonialController extends \App\Http\Controllers\Controller
{
    /** @var  TestimonialRepository */
    private $testimonialRepository;

    public function __construct(TestimonialRepository $testimonialRepo)
    {
        $this->testimonialRepository = $testimonialRepo;
    }

    /**
     * Display a listing of the Testimonial.
     *
     * @param TestimonialDataTable $testimonialDataTable
     * @return Response
     */
    public function index(TestimonialDataTable $testimonialDataTable)
    {
        return $testimonialDataTable->render('admin.testimonials.index');
    }

    /**
     * Show the form for creating a new Testimonial.
     *
     * @return Response
     */
    public function create()
    {   
        $users = User::all();
        return view('admin.testimonials.create', compact('users'));
    }

    /**
     * Store a newly created Testimonial in storage.
     *
     * @param CreateTestimonialRequest $request
     *
     * @return Response
     */
    public function store(CreateTestimonialRequest $request)
    {
        $input = $request->all();

        $testimonial = $this->testimonialRepository->create($input);

        alert()->success('Testimonial saved successfully.');

        return redirect(route('admin.testimonials.index'));
    }

    /**
     * Display the specified Testimonial.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $testimonial = $this->testimonialRepository->findWithoutFail($id);

        if (empty($testimonial)) {
            alert()->error('Testimonial no encontrad@');

            return redirect(route('admin.testimonials.index'));
        }

        return view('admin.testimonials.show')->with('testimonial', $testimonial);
    }

    /**
     * Show the form for editing the specified Testimonial.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $testimonial = $this->testimonialRepository->findWithoutFail($id);

        if (empty($testimonial)) {
            alert()->error('Testimonial no encontrad@');

            return redirect(route('admin.testimonials.index'));
        }
        
        $users = User::all();

        return view('admin.testimonials.edit')->with('testimonial', $testimonial)->with(compact('users'));
    }

    /**
     * Update the specified Testimonial in storage.
     *
     * @param  int              $id
     * @param UpdateTestimonialRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateTestimonialRequest $request)
    {
        $testimonial = $this->testimonialRepository->findWithoutFail($id);

        if (empty($testimonial)) {
            alert()->error('Testimonial no encontrad@');

            return redirect(route('admin.testimonials.index'));
        }

        $testimonial = $this->testimonialRepository->update($request->all(), $id);

        alert()->success('Testimonial actualizad@ exitosamente.');

        return back();
    }

    /**
     * Remove the specified Testimonial from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $testimonial = $this->testimonialRepository->findWithoutFail($id);

        if (empty($testimonial)) {
            alert()->error('Testimonial no encontrad@');

            return redirect(route('admin.testimonials.index'));
        }

        $this->testimonialRepository->delete($id);

        alert()->success('Testimonial eliminad@ exitosamente.');

        return redirect(route('admin.testimonials.index'));
    }
}
