<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;

/**
 * Class StoreController
 * @package App\Http\Controllers\API
 */

class MediaAPIController extends \App\Http\Controllers\Controller
{
    public function store(Request $request)
    {
        $paths = [];

        if (!$request->hasFile('file')) {
            $this->sendError('No media in request');
        }

        $request->validate([
            'file' => 'file|between:1,20000',
        ]);

        // $name = $image_file->getClientOriginalName();
        $path = $request->file('file')->store('uploads');

        $paths[] = $path;

        if (empty($paths)) {
            $this->sendError('No media uploaded');
        }

        return $this->sendResponse($paths, 'Media saved successfully');
    }
}