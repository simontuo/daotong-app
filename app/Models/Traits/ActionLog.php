<?php
namespace App\Models\Traits;

use App\Jobs\ActionLogSlug;

trait ActionLog
{
    public function actionLog($user, string $action)
    {
        dispatch(new ActionLogSlug($user, $action, $this));
    }
}
