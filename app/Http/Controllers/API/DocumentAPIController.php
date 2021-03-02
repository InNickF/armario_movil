<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;

/**
 * Class StoreController
 * @package App\Http\Controllers\API
 */

class DocumentAPIController extends \App\Http\Controllers\Controller
{
    public function store(Request $request)
    {
        $paths = [];

        if (!$request->hasFile('file')) {
            $this->sendError('No documents in request');
        }

        $request->validate([
            'file' => 'file|mimes:jpeg,jpg,png,pdf,xml|between:1,5000',
        ]);

        // $name = $document_file->getClientOriginalName();
        $path = $request->file('file')->store('uploads');
           
        $paths[] = $path;

        if (empty($paths)) {
            $this->sendError('No documents uploaded');
        }

        return $this->sendResponse($paths, 'Document saved successfully');
    }
}
