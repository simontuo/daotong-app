<?php
namespace App\Uploader;

use Storage;

class Uploader
{
    /**
     * [uploadQiniu 上传七牛]
     * @param  [type] $fileName [文件名]
     * @param  [type] $file     [文件]
     * @return [type]           [回调地址]
     */
    public function uploadQiniu($fileName, $file)
    {
        Storage::disk('qiniu')->writeStream($fileName, fopen($file->getRealPath(), 'r'));

        return 'http://'.config('filesystems.disks.qiniu.domain').'/'.$fileName;
    }
}
