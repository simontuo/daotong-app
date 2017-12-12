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

    public function search(Request $request, $file)
    {
        LaravelLogViewer::setFile($file);

        $page = $request->get('page');

        $pageSize = $request->get('pageSize');



        $logsCollect = collect(LaravelLogViewer::all());

        $logs = $logsCollect->forPage($page, $pageSize);

        $total = $logsCollect->count();

        $files = LaravelLogViewer::getFiles(true);

        $current_file = LaravelLogViewer::getFileName();

        return response()->json([
            'logs' => $logs,
            'files' => $files,
            'current_file' => $current_file,
            'total' => $total
        ]);
    }

    public function getFiles()
    {
        $files = LaravelLogViewer::getFiles(true);

        return response()->json(['files' => $files]);
    }

}
