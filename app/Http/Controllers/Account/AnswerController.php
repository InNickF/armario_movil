<?php

namespace App\Http\Controllers\Account;

use App\Models\Question;
use App\Mail\QuestionAnswered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Repositories\Account\AnswerRepository;
use App\Http\Requests\Account\CreateAnswerRequest;
use App\Models\Answer;

class AnswerController extends \App\Http\Controllers\Controller
{
    /** @var  AnswerRepository */
    private $answerRepository;

    public function __construct(AnswerRepository $answerRepo)
    {
        $this->answerRepository = $answerRepo;
    }


    public function index()
    {
        $questions = Question::whereHas('product', function ($p) {
            $p->where('store_id', auth()->user()->store->id);
        })->latest()->paginate(10);
        return view('account.answers.index', compact('questions'));
    }

    public function store(CreateAnswerRequest $request)
    {
        try {
            $input = $request->all();
            $input['user_id'] = auth()->user()->id;

            $answer = $this->answerRepository->create($input);
            $answer = Answer::find($answer->id);
            // dd($answer);

            if ($answer->user_id != $answer->question->user->id) { // Send to client who asked only if response is from other user than himself
                Mail::to($answer->question->user)->send(new QuestionAnswered($answer));
            }
        } catch (\Throwable $th) {
            alert()->error('Ha ocurrido un error al generar tu respuesta');
            return back();
        }

        alert()->success('Tu respuesta ha sido generada correctamente');

        return back();
    }


    public function edit($id)
    {
        $question = Question::find($id);

        if (empty($question)) {
            alert()->error('Pregunta no encontrada');

            return redirect(route('account.questions.index'));
        }

        return view('account.questions.answers.edit')->with('question', $question);
    }
}
