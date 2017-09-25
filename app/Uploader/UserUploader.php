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

    public function uploadMarkdownImage(User $user, $file)
    {
        $fileName = '/markdown/images'.md5(time().$user->name).'.'.$file->getClientOriginalExtension();

        $callBackUrl = $this->uploadQiniu($fileName, $file);

        return ['name' => $fileName, 'url' => $callBackUrl];
    }
}
