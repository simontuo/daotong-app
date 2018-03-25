<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Uploader\UserUploader;
use App\Repositories\UserRepository;

class UploadsController extends Controller
{
    public function __construct(UserRepository $user)
    {
        $this->user = $user;
    }

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

    public function avatar(Request $request, $id)
    {
        $user = $this->user->byId($id);

        $this->authorize('uploadAvatar', $user);

        if ($request->hasFile('file')) {
            (new UserUploader())->uploadAvatar($user, $request->file('file'));

            user('api')->actionLog(user('api'), user('api')->name.'上传了用户'.$user->name.'的头像:'.$user->avatar);

            return response()->json(['url' => $user->avatar]);
        }
    }

    public function wechatCode(Request $request, $id)
    {
        $user = $this->user->byId($id);

        $this->authorize('uploadWechatCode', $user);

        if ($request->hasFile('file')) {
            (new UserUploader())->uploadWechatCode($user, $request->file('file'));

            user('api')->actionLog(user('api'), user('api')->name.'上传了用户'.$user->name.'的微信二维码:'.$user->settings['wechatCode']);

            return response()->json(['url' => $user->settings['wechatCode']]);
        }

        abort(401);
    }

    public function alipayCode(Request $request, $id)
    {
        $user = $this->user->byId($id);

        $this->authorize('uploadAlipayCode', $user);

        if (user('api')->isMyself($user) && $request->hasFile('file')) {
            (new UserUploader())->uploadAlipayCode($user, $request->file('file'));

            user('api')->actionLog(user('api'), user('api')->name.'上传了用户'.$user->name.'的支付宝二维码:'.$user->settings['alipayCode']);

            return response()->json(['url' => $user->settings['alipayCode']]);
        }

        abort(401);
    }

    public function poster(Request $request)
    {
        $this->authorize('viewAdmin', user('api'));

        if ($request->hasFile('file')) {
            return (new UserUploader())->uploadPoster(user('api'), $request->file('file'));
        }

        abort(500);
    }
}
