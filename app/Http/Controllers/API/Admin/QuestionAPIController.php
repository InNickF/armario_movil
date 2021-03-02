<?php

namespace App\Http\Controllers\API\Admin;

use App\Models\Question;


class QuestionAPIController extends \App\Http\Controllers\Controller
{
    public function toggleActive($id)
    {
        $question = Question::find($id);

        if (empty($question)) {
            return $this->sendError('Question not found');
        }

        // $comment = request('comment');

        $question->is_active = !$question->is_active;
        // $question->admin_comment = $comment;
        $question->save();

        return $this->sendResponse($question->toArray(), 'Question active status changed successfully');
    }
}
