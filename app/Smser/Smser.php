<?php
namespace App\Smser;

use Overtrue\EasySms\EasySms;

class Smser
{
    public function aliyunSend($toPhone, $template, $data)
    {
        $easySms = new EasySms(config('easysms.config'));

        $easySms->send($toPhone, [
            'template' => $template,
            'data'     => $data,
        ]);

    }
}
