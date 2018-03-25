<?php
namespace App\Uploader;

use App\Uploader\Uploader;
use App\Models\User;

class UserUploader extends Uploader
{

    /**
     * [uploadAvatar 上传头像]
     * @param  User   $user [description]
     * @param  [type] $file [description]
     * @return [type]       [description]
     */
    public function uploadAvatar(User $user, $file)
    {
        $fileName = '/avatars/'.md5(time().$user->name).'.'.$file->getClientOriginalExtension();

        $callBackUrl = $this->uploadQiniu($fileName, $file);

        $user->avatar = $callBackUrl;
        $user->save();
    }

    /**
     * [uploadWechatCode 上传微信二维码]
     * @param  User   $user [description]
     * @param  [type] $file [description]
     * @return [type]       [description]
     */
    public function uploadWechatCode(User $user, $file)
    {
        $fileName = '/wechatCode/'.md5(time().$user->name).'.'.$file->getClientOriginalExtension();

        $callBackUrl = $this->uploadQiniu($fileName, $file);

        $user->update($user->merge(['wechatCode' => $callBackUrl]));
        $user->save();
    }

    /**
     * [uploadAlipayCode 上传Alipay二维码]
     * @param  User   $user [description]
     * @param  [type] $file [description]
     * @return [type]       [description]
     */
    public function uploadAlipayCode(User $user, $file)
    {
        $fileName = '/alipayCode/'.md5(time().$user->name).'.'.$file->getClientOriginalExtension();

        $callBackUrl = $this->uploadQiniu($fileName, $file);

        $user->update($user->merge(['alipayCode' => $callBackUrl]));
        $user->save();
    }

    /**
     * [uploadCover 上传封面]
     * @param  User   $user [description]
     * @param  [type] $file [description]
     * @return [type]       [description]
     */
    public function uploadCover(User $user, $file)
    {
        $fileName = '/covers/'.md5(time().$user->name).'.'.$file->getClientOriginalExtension();

        $callBackUrl = $this->uploadQiniu($fileName, $file);

        return ['name' => $fileName, 'url' => $callBackUrl];
    }

    /**
     * [uploadMarkdownImage 上传markdown图片]
     * @param  User   $user [description]
     * @param  [type] $file [description]
     * @return [type]       [description]
     */
    public function uploadMarkdownImage(User $user, $file)
    {
        $fileName = '/markdown/images/'.md5(time().$user->name).'.'.$file->getClientOriginalExtension();

        $callBackUrl = $this->uploadQiniu($fileName, $file);

        return ['name' => $fileName, 'url' => $callBackUrl];
    }

    /**
     * [uploadListImage 上传列图片]
     * @param  User   $user [description]
     * @param  [type] $file [description]
     * @return [type]       [description]
     */
    public function uploadListImage(User $user, $file)
    {
        $fileName = '/list/images/'.md5(time().$user->name).'.'.$file->getClientOriginalExtension();

        $callBackUrl = $this->uploadQiniu($fileName, $file);

        return ['name' => $fileName, 'url' => $callBackUrl];
    }

    public function uploadPoster(User $user, $file)
    {
        $fileName = '/poster/'.md5(time().$user->name).'.'.$file->getClientOriginalExtension();

        $callBackUrl = $this->uploadQiniu($fileName, $file);

        return ['name' => $fileName, 'url' => $callBackUrl];
    }
}
