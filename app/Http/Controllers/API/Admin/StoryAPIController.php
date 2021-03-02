<?php

namespace App\Http\Controllers\API\Admin;

use App\Models\Story;


class StoryAPIController extends \App\Http\Controllers\Controller
{
    public function toggleActive($id)
    {
        $story = Story::find($id);

        if (empty($story)) {
            return $this->sendError('Historia no encontrado');
        }

        $comment = request('comment');

        $story->is_active = !$story->is_active;
        $story->admin_comment = $comment;
        $story->save();

        return $this->sendResponse($story->toArray(), 'Story active status changed successfully');
    }
}
