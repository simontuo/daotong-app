<?php
namespace App\Smser;

use App\Smser\Smser;

class AliyunSmser extends Smser
{
    public function registerSms($toPhone)
    {
        $template = config('easysms.aliyunTemplate.registerCode.template');

        $data = [
            config('easysms.aliyunTemplate.registerCode.variable') => rand(pow(10,(6-1)), pow(10,6)-1),
        ];

        $this->aliyunSend($toPhone, $template, $data);
    }
}
