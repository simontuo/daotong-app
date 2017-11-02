<?php

namespace App\Models\Traits;

use Log;
use App\Jobs\ActionLogSlug;

trait WorkLog
{
    public function actionLog($user)
    {
        $action = '测试队列，感觉好神奇！';
        
        dispatch(new ActionLogSlug($user, $action));
    }
}
