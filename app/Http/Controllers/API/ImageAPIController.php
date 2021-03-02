<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Spatie\Image\Image;

/**
 * Class StoreController.
 */
class ImageAPIController extends \App\Http\Controllers\Controller
{
    public function store(Request $request)
    {
        if (!$request->hasFile('file')) {
            $this->sendError('No hay archivo en la solicitud');
        }

        $messages = [
            'file.between' => 'El tamaño de la imagen no debe ser mayor a 5MB',
            'file.mimes' => 'El formato no es correcto',
        ];

        $request->validate([
            'file' => 'image|max:10000|mimes:jpeg,jpg,png,gif,svg,html',
        ], $messages);

        $file = $request->file('file');

        if (is_null($file) || empty($file)) {
            $this->sendError('No se ha encontrado el archivo');
        }

        $path = $file->store('uploads');

        if (!$path) {
            $this->sendError('No se pudo guardar la imagen');
        }

        $fullPath = public_path('storage/'.$path);

        // Limit width & optimize
        $image = Image::load($fullPath);

        $image->width(1400)
        // ->height(1080)
            ->optimize()
            ->save()
        ;

        return $this->sendResponse([$path], 'Imagen guardada');
    }
}