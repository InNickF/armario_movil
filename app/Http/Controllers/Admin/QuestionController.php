<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\QuestionDataTable;
use App\Http\Requests\Admin;
use App\Http\Requests\Admin\CreateQuestionRequest;
use App\Http\Requests\Admin\UpdateQuestionRequest;
use App\Repositories\Admin\QuestionRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class QuestionController extends \App\Http\Controllers\Controller
{
    /** @var  QuestionRepository */
    private $questionRepository;

    public function __construct(QuestionRepository $questionRepo)
    {
        $this->questionRepository = $questionRepo;
    }

    /**
     * Display a listing of the Question.
     *
     * @param QuestionDataTable $questionDataTable
     * @return Response
     */
    public function index(QuestionDataTable $questionDataTable)
    {
        return $questionDataTable->render('admin.questions.index');
    }

    /**
     * Show the form for creating a new Question.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.questions.create');
    }

    /**
     * Store a newly created Question in storage.
     *
     * @param CreateQuestionRequest $request
     *
     * @return Response
     */
    public function store(CreateQuestionRequest $request)
    {
        $input = $request->all();

        $question = $this->questionRepository->create($input);

        alert()->success('Question saved successfully.');

        return redirect(route('admin.questions.index'));
    }

    /**
     * Display the specified Question.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $question = $this->questionRepository->findWithoutFail($id);

        if (empty($question)) {
            alert()->error('Question no encontrad@');

            return redirect(route('admin.questions.index'));
        }

        return view('admin.questions.show')->with('question', $question);
    }

    /**
     * Show the form for editing the specified Question.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $question = $this->questionRepository->findWithoutFail($id);

        if (empty($question)) {
            alert()->error('Question no encontrad@');

            return redirect(route('admin.questions.index'));
        }

        return view('admin.questions.edit')->with('question', $question);
    }

    /**
     * Update the specified Question in storage.
     *
     * @param  int              $id
     * @param UpdateQuestionRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateQuestionRequest $request)
    {
        $question = $this->questionRepository->findWithoutFail($id);

        if (empty($question)) {
            alert()->error('Question no encontrad@');

            return redirect(route('admin.questions.index'));
        }

        $question = $this->questionRepository->update($request->all(), $id);

        alert()->success('Question actualizad@ exitosamente.');

        return back();
    }

    /**
     * Remove the specified Question from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $question = $this->questionRepository->findWithoutFail($id);

        if (empty($question)) {
            alert()->error('Question no encontrad@');

            return redirect(route('admin.questions.index'));
        }

        $this->questionRepository->delete($id);

        alert()->success('Question eliminad@ exitosamente.');

        return redirect(route('admin.questions.index'));
    }
}
