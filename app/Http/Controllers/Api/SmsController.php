<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Smser\AliyunSmser;
use Cache;

class SmsController extends Controller
{
    public function registerCode(Request $request)
    {
        $phone = $request->get('phone');

        $verificationCode = rand(pow(10,(6-1)), pow(10,6)-1);

        (new AliyunSmser())->registerSms($phone, $verificationCode);

        Cache::put($phone, $verificationCode, 5);

        return response()->json(['status' => true]);
    }

    public function verifyRegisterCode()
    {
        dd('test');
    }
}
