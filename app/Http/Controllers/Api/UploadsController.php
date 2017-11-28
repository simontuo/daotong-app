<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Uploader\UserUploader;

class UploadsController extends Controller
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

    /**
     * [markdownImage 上传markdown图片]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function markdownImage(Request $request)
    {
        if ($request->hasFile('img')) {
            return (new UserUploader())->uploadMarkdownImage(user('api'), $request->file('img'));
        }

        abort(500);
    }

    /**
     * [listImage 上传图片列]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function listImage(Request $request)
    {
        if ($request->hasFile('file')) {
            return (new UserUploader())->uploadListImage(user('api'), $request->file('file'));
        }

        abort(500);
    }
}
