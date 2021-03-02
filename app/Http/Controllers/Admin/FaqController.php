<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\FaqDataTable;
use App\Http\Requests\Admin;
use App\Http\Requests\Admin\CreateFaqRequest;
use App\Http\Requests\Admin\UpdateFaqRequest;
use App\Repositories\Admin\FaqRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;
use App\Models\FaqCategory;
use Illuminate\Support\Facades\Auth;

class FaqController extends \App\Http\Controllers\Controller
{
    /** @var  FaqRepository */
    private $faqRepository;

    public function __construct(FaqRepository $faqRepo)
    {
        $this->faqRepository = $faqRepo;
    }

    /**
     * Display a listing of the Faq.
     *
     * @param FaqDataTable $faqDataTable
     * @return Response
     */
    public function index(FaqDataTable $faqDataTable)
    {
        return $faqDataTable->render('admin.faqs.index');
    }

    /**
     * Show the form for creating a new Faq.
     *
     * @return Response
     */
    public function create()
    {   
        $categories = FaqCategory::all();
        return view('admin.faqs.create')->withCategories($categories);
    }

    /**
     * Store a newly created Faq in storage.
     *
     * @param CreateFaqRequest $request
     *
     * @return Response
     */
    public function store(CreateFaqRequest $request)
    {
        $input = $request->all();
        $input['user_id'] = Auth::user()->id;
        $faq = $this->faqRepository->create($input);

        alert()->success('Faq guardado');

        return redirect(route('admin.faqs.index'));
    }

    /**
     * Display the specified Faq.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $faq = $this->faqRepository->findWithoutFail($id);

        if (empty($faq)) {
            alert()->error('Faq no encontrado');

            return redirect(route('admin.faqs.index'));
        }

        return view('admin.faqs.show')->with('faq', $faq);
    }

    /**
     * Show the form for editing the specified Faq.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $faq = $this->faqRepository->findWithoutFail($id);

        if (empty($faq)) {
            alert()->error('Faq no encontrado');

            return redirect(route('admin.faqs.index'));
        }
        $categories = FaqCategory::all();
        return view('admin.faqs.edit')->with('faq', $faq)->withCategories($categories);
    }

    /**
     * Update the specified Faq in storage.
     *
     * @param  int              $id
     * @param UpdateFaqRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateFaqRequest $request)
    {
        $faq = $this->faqRepository->findWithoutFail($id);

        if (empty($faq)) {
            alert()->error('Faq no encontrado');

            return redirect(route('admin.faqs.index'));
        }

        $faq = $this->faqRepository->update($request->all(), $id);

        alert()->success('Faq actualizado');

        return back();
    }

    /**
     * Remove the specified Faq from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $faq = $this->faqRepository->findWithoutFail($id);

        if (empty($faq)) {
            alert()->error('Faq no encontrado');

            return redirect(route('admin.faqs.index'));
        }

        $this->faqRepository->delete($id);

        alert()->success('Faq eliminado');

        return redirect(route('admin.faqs.index'));
    }
}
