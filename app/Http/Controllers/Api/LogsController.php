<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Rap2hpoutre\LaravelLogViewer\LaravelLogViewer;

class LogsController extends Controller
{
    public function search(Request $request, $file)
    {
        $this->authorize('viewAdminLog', user('api'));

        LaravelLogViewer::setFile($file);

        $page = $request->get('page');

        $pageSize = $request->get('pageSize');

        $query = request('query');

        $logsCollect = collect(LaravelLogViewer::all())->filter(function ($item, $key) use($query) {
            if (is_null($query)) {
                return $item;
            }

            if (strpos($item['text'], $query)) {
                return $item;
            }
        });

        $logs = [];

        foreach ($logsCollect->forPage($page, $pageSize) as $key => $value) {
            $logs[] = $value;
        }

        $total = $logsCollect->count();

        $files = LaravelLogViewer::getFiles(true);

        $current_file = LaravelLogViewer::getFileName();

        return response()->json([
            'logs'         => $logs,
            'files'        => $files,
            'current_file' => $current_file,
            'total'        => $total
        ]);
    }

    public function getFiles()
    {
        $files = LaravelLogViewer::getFiles(true);

        return response()->json(['files' => $files]);
    }

}
