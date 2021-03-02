<?php

namespace App\Http\Controllers\API\Dashboard;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

/**
 * Class StoreController.
 */
class ImageAPIController extends \App\Http\Controllers\Controller
{
    public function store(Request $request)
    {
        $paths = [];
        if (!$request->hasFile('file')) {
            $this->sendError('No images in request');
        }

        $request->validate([
            'file' => 'image|between:1,25000|mimes:jpeg,jpg,png,gif',
        ]);

        // $name = $image_file->getClientOriginalName();
        // Storage::makeDirectory('dashboard');

        $path = $request->file('file')->storeAs('dashboard', request('name'));

        $paths[] = $path;

        if (empty($paths)) {
            $this->sendError('No images uploaded');
        }

        return $this->sendResponse($paths, 'Images saved successfully');
    }
}