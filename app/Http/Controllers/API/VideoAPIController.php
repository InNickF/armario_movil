<?php

namespace App\Http\Controllers\API;

use FFMpeg\Coordinate\Dimension;
use FFMpeg\Coordinate\FrameRate;
use FFMpeg\FFMpeg;
use FFMpeg\Format\Video\X264;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

/**
 * Class StoreController.
 */
class VideoAPIController extends \App\Http\Controllers\Controller
{
    public function store(Request $request)
    {
        $paths = [];

        if (!$request->hasFile('file')) {
            $this->sendError('No video in request');
        }

        $request->validate([
            'file' => 'required|mimes:mp4,avi,mkv|max:20000',
        ]);

        $path = $request->file('file')->store('uploads');
        \Log::info('original video stored');

        // Resize
        $fullPath = public_path('storage/'.$path);
        $ffmpeg = FFMpeg::create([
            'timeout' => 360000,
        ]);

        // $video
        //     ->frame(FFMpeg\Coordinate\TimeCode::fromSeconds(10))
        //     ->save('frame.jpg');

        $video = $ffmpeg->open($fullPath);

        \Log::info('Optimizing original...');
        $framerate = new FrameRate(29);

        $video->filters()
            ->framerate($framerate, 12)
        // ->resize(new Dimension(800, 600), 'inset', false)
            ->pad(new Dimension(800, 600))
            ->synchronize()
        ;

        $convertedPath = $path.'-converted.mp4';
        $format = new X264('libmp3lame');
        $format->setKiloBitrate(900)->setAudioChannels(2)->setAudioKiloBitrate(128);

        \Log::info('Saving optimized copy...');
        $video->save($format, public_path('storage/'.$convertedPath));

        \Log::info('video converted saved');
        Storage::delete($path);

        // \Log::info('video original deleted');

        $paths[] = $convertedPath;

        if (empty($paths)) {
            $this->sendError('No video uploaded');
        }

        \Log::info($paths);

        return $this->sendResponse($paths, 'Videos saved successfully');
    }
}