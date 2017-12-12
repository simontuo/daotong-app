<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Rap2hpoutre\LaravelLogViewer\LaravelLogViewer;

class LogsController extends Controller
{
    protected $request;

    public function __construct ()
    {
        $this->request = app('request');
    }

    public function search($file)
    {
        LaravelLogViewer::setFile($file);
        return LaravelLogViewer::all();
        $logs = LaravelLogViewer::all();
        $files = LaravelLogViewer::getFiles(true);
        $current_file = LaravelLogViewer::getFileName();

        return response()->json([
            'logs' => $logs,
            'files' => $files,
            'current_file' => $current_file
        ]);
    }

}
