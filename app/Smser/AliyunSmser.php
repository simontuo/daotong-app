<?php
namespace App\Smser;

use App\Smser\Smser;

class AliyunSmser extends Smser
{
    public function registerSms($toPhone, $verificationCode)
    {
        $template = config('easysms.aliyunTemplate.registerCode.template');

        $data = [
            config('easysms.aliyunTemplate.registerCode.variable') => $verificationCode,
        ];

        $this->aliyunSend($toPhone, $template, $data);
    }
}
