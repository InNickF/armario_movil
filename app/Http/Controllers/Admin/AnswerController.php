<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\AnswerDataTable;
use App\Http\Requests\Admin;
use App\Http\Requests\Admin\CreateAnswerRequest;
use App\Http\Requests\Admin\UpdateAnswerRequest;
use App\Repositories\Admin\AnswerRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class AnswerController extends \App\Http\Controllers\Controller
{
    /** @var  AnswerRepository */
    private $answerRepository;

    public function __construct(AnswerRepository $answerRepo)
    {
        $this->answerRepository = $answerRepo;
    }

    /**
     * Display a listing of the Answer.
     *
     * @param AnswerDataTable $answerDataTable
     * @return Response
     */
    public function index(AnswerDataTable $answerDataTable)
    {
        return $answerDataTable->render('admin.answers.index');
    }

    /**
     * Show the form for creating a new Answer.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.answers.create');
    }

    /**
     * Store a newly created Answer in storage.
     *
     * @param CreateAnswerRequest $request
     *
     * @return Response
     */
    public function store(CreateAnswerRequest $request)
    {
        $input = $request->all();

        $answer = $this->answerRepository->create($input);

        alert()->success('ha sido generada correctamente');

        return redirect(route('answers.index'));
    }

    /**
     * Display the specified Answer.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $answer = $this->answerRepository->findWithoutFail($id);

        if (empty($answer)) {
            alert()->error('Answer no encontrad@');

            return redirect(route('answers.index'));
        }

        return view('admin.answers.show')->with('answer', $answer);
    }

    /**
     * Show the form for editing the specified Answer.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $answer = $this->answerRepository->findWithoutFail($id);

        if (empty($answer)) {
            alert()->error('Answer no encontrad@');

            return redirect(route('answers.index'));
        }

        return view('admin.answers.edit')->with('answer', $answer);
    }

    /**
     * Update the specified Answer in storage.
     *
     * @param  int              $id
     * @param UpdateAnswerRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateAnswerRequest $request)
    {
        $answer = $this->answerRepository->findWithoutFail($id);

        if (empty($answer)) {
            alert()->error('Answer no encontrad@');

            return redirect(route('answers.index'));
        }

        $answer = $this->answerRepository->update($request->all(), $id);

        alert()->success('Answer actualizad@ exitosamente.');

        return back();
    }

    /**
     * Remove the specified Answer from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $answer = $this->answerRepository->findWithoutFail($id);

        if (empty($answer)) {
            alert()->error('Answer no encontrad@');

            return redirect(route('answers.index'));
        }

        $this->answerRepository->delete($id);

        alert()->success('Answer eliminad@ exitosamente.');

        return redirect(route('answers.index'));
    }
}
