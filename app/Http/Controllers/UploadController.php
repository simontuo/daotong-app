<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Uploader\UserUploader;

class UploadController extends Controller
{

    /**
     * [cover 上传封面]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function cover(Request $request)
    {
        if ($request->hasFile('file')) {
            return (new UserUploader())->uploadCover(user('api'), $request->file('file'));
        }

        abort(500);
    }
}
