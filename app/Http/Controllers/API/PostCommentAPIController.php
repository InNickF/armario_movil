<?php

namespace App\Http\Controllers\API;

use Response;
use App\Models\PostComment;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;
use App\Http\Controllers\AppBaseController;
use App\Repositories\PostCommentRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use App\Http\Requests\API\CreatePostCommentAPIRequest;
use App\Http\Requests\API\UpdatePostCommentAPIRequest;
use Spatie\QueryBuilder\Filter;

/**
 * Class PostCommentController
 * @package App\Http\Controllers\API
 */

class PostCommentAPIController extends \App\Http\Controllers\Controller
{
    /** @var  PostCommentRepository */
    private $postCommentRepository;

    public function __construct(PostCommentRepository $postCommentRepo)
    {
        $this->postCommentRepository = $postCommentRepo;
    }

    /**
     * Display a listing of the PostComment.
     * GET|HEAD /postComments
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $questions = QueryBuilder::for(PostComment::class)
            ->allowedIncludes('post', 'user')
            ->allowedFilters(Filter::exact('post_id'))
            ->defaultSort('created_at')
            ->allowedSorts('created_at')
            ->paginate($request->query('limit'));

        return $questions;
    }

    /**
     * Store a newly created PostComment in storage.
     * POST /postComments
     *
     * @param CreatePostCommentAPIRequest $request
     *
     * @return Response
     */
    public function store(CreatePostCommentAPIRequest $request)
    {
        $input = $request->all();
        $input['user_id'] = auth('api')->user()->id;

        $postComments = PostComment::create($input);

        return $this->sendResponse($postComments->toArray(), 'Post Comment saved successfully');
    }

    /**
     * Display the specified PostComment.
     * GET|HEAD /postComments/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var PostComment $postComment */
        $postComment = $this->postCommentRepository->findWithoutFail($id);

        if (empty($postComment)) {
            return $this->sendError('Post Comment not found');
        }

        return $this->sendResponse($postComment->toArray(), 'Post Comment retrieved successfully');
    }

    /**
     * Update the specified PostComment in storage.
     * PUT/PATCH /postComments/{id}
     *
     * @param  int $id
     * @param UpdatePostCommentAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePostCommentAPIRequest $request)
    {
        $input = $request->all();

        /** @var PostComment $postComment */
        $postComment = $this->postCommentRepository->findWithoutFail($id);

        if (empty($postComment)) {
            return $this->sendError('Post Comment not found');
        }

        $postComment = $this->postCommentRepository->update($input, $id);

        return $this->sendResponse($postComment->toArray(), 'PostComment updated successfully');
    }

    /**
     * Remove the specified PostComment from storage.
     * DELETE /postComments/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var PostComment $postComment */
        $postComment = $this->postCommentRepository->findWithoutFail($id);

        if (empty($postComment)) {
            return $this->sendError('Post Comment not found');
        }

        $postComment->delete();

        return $this->sendResponse($id, 'Post Comment ha sido eliminado');
    }
}
