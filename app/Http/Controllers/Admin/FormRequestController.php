<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\FormRequestDataTable;
use App\Http\Requests\Admin;
use App\Http\Requests\Admin\CreateFormRequestRequest;
use App\Http\Requests\Admin\UpdateFormRequestRequest;
use App\Repositories\Admin\FormRequestRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class FormRequestController extends \App\Http\Controllers\Controller
{
    /** @var  FormRequestRepository */
    private $formRequestRepository;

    public function __construct(FormRequestRepository $formRequestRepo)
    {
        $this->formRequestRepository = $formRequestRepo;
    }

    /**
     * Display a listing of the FormRequest.
     *
     * @param FormRequestDataTable $formRequestDataTable
     * @return Response
     */
    public function index(FormRequestDataTable $formRequestDataTable)
    {
        return $formRequestDataTable->render('admin.form_requests.index');
    }

    /**
     * Show the form for creating a new FormRequest.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.form_requests.create');
    }

    /**
     * Store a newly created FormRequest in storage.
     *
     * @param CreateFormRequestRequest $request
     *
     * @return Response
     */
    public function store(CreateFormRequestRequest $request)
    {
        $input = $request->all();

        $formRequest = $this->formRequestRepository->create($input);

        alert()->success('Email Subscription saved successfully.');

        return redirect(route('admin.formRequests.index'));
    }

    /**
     * Display the specified FormRequest.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $formRequest = $this->formRequestRepository->findWithoutFail($id);

        if (empty($formRequest)) {
            alert()->error('Email Subscription no encontrad@');

            return redirect(route('admin.formRequests.index'));
        }

        return view('admin.form_requests.show')->with('formRequest', $formRequest);
    }

    /**
     * Show the form for editing the specified FormRequest.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $formRequest = $this->formRequestRepository->findWithoutFail($id);

        if (empty($formRequest)) {
            alert()->error('Email Subscription no encontrad@');

            return redirect(route('admin.formRequests.index'));
        }

        return view('admin.form_requests.edit')->with('formRequest', $formRequest);
    }

    /**
     * Update the specified FormRequest in storage.
     *
     * @param  int              $id
     * @param UpdateFormRequestRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateFormRequestRequest $request)
    {
        $formRequest = $this->formRequestRepository->findWithoutFail($id);

        if (empty($formRequest)) {
            alert()->error('Email Subscription no encontrad@');

            return redirect(route('admin.formRequests.index'));
        }

        $formRequest = $this->formRequestRepository->update($request->all(), $id);

        alert()->success('Email Subscription actualizad@ exitosamente.');

        return back();
    }

    /**
     * Remove the specified FormRequest from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $formRequest = $this->formRequestRepository->findWithoutFail($id);

        if (empty($formRequest)) {
            alert()->error('Email Subscription no encontrad@');

            return redirect(route('admin.formRequests.index'));
        }

        $this->formRequestRepository->delete($id);

        alert()->success('Email Subscription eliminad@ exitosamente.');

        return redirect(route('admin.formRequests.index'));
    }
}
