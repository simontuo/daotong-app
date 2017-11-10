<?php
namespace App\Models\Traits;

use App\Jobs\ActionLogSlug;

trait ActionLog
{
    public function actionLog($user)
    {
        $action = '新增了评论！';

        dispatch(new ActionLogSlug($user, $action, $this));
    }
}
