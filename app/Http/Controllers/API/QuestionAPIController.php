<?php

namespace App\Http\Controllers\API;

use App\Models\Question;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\Filter;
use Illuminate\Support\Facades\Mail;
use Spatie\QueryBuilder\QueryBuilder;
use App\Mail\QuestionAskedOnMyProduct;
use App\Repositories\QuestionRepository;
use App\Http\Requests\API\CreateQuestionAPIRequest;

/**
 * Class QuestionController
 * @package App\Http\Controllers\API
 */

class QuestionAPIController extends \App\Http\Controllers\Controller
{
    /** @var  QuestionRepository */
    private $questionRepository;

    public function __construct(QuestionRepository $questionRepo)
    {
        $this->questionRepository = $questionRepo;
    }
    public function index(Request $request)
    {
        $questions = QueryBuilder::for(Question::class)
            ->allowedIncludes(['answers', 'product'])
            ->allowedFilters(['body', Filter::exact('product_id')])
            ->defaultSort('-created_at')
            ->allowedSorts('created_at')
            ->where('is_active', true)
            ->paginate($request->query('limit'));

        return $questions;
    }



    public function store(CreateQuestionAPIRequest $request)
    {
        if (!auth('api')->check()) {
            return $this->sendError('Necesita iniciar sesión para hacer una pregunta', 403);
        }
        $input = $request->all();
        $input['user_id'] = auth('api')->user()->id;

        $question = $this->questionRepository->create($input);
        $question = Question::find($question->id);

        // Trigger: Tienda recibe pregunta
        Mail::to($question->product->store->user)->send(new QuestionAskedOnMyProduct($question));

        return $this->sendResponse($question->toArray(), 'Question saved successfully');
    }

}
