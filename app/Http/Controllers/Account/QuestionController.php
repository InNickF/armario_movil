<?php

namespace App\Http\Controllers\Account;

use App\DataTables\Account\QuestionDataTable;
use App\Http\Requests\Account;
use App\Http\Requests\Account\CreateQuestionRequest;
use App\Http\Requests\Account\UpdateQuestionRequest;
use App\Repositories\Account\QuestionRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;
use App\Models\Question;
use Illuminate\Support\Facades\Auth;

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
    public function index()
    {   
        $questions = Question::where('user_id', Auth::user()->id)->paginate(10);
        return view('account.questions.index', compact('questions'));
    }

    /**
     * Show the form for creating a new Question.
     *
     * @return Response
     */
    public function create()
    {
        return view('account.questions.create');
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
        $input['user_id'] = Auth::user()->id;

        $question = $this->questionRepository->create($input);

        alert()->success('Question saved successfully.');

        return back();
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

            return redirect(route('account.questions.index'));
        }

        return view('account.questions.show')->with('question', $question);
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
            alert()->error('Pregunta no encontrada');

            return redirect(route('account.questions.index'));
        }

        return view('account.questions.edit')->with('question', $question);
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

            return redirect(route('account.questions.index'));
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

            return redirect(route('account.questions.index'));
        }

        $this->questionRepository->delete($id);

        alert()->success('Question eliminad@ exitosamente.');

        return redirect(route('account.questions.index'));
    }
}
