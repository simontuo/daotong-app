<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

use Log;
use App\Models\User;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class ActionLogSlug implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $user;

    protected $allowUserField = ['id', 'name', 'email', 'phone'];

    protected $action;

    protected $model;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(User $user, $action, $model)
    {
        $this->user = $user;
        $this->action = $action;
        $this->model = $model;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $log = new Logger('actionLog');

        $path = storage_path('logs/actionLog.log');

        $log->pushHandler(new StreamHandler($path, Logger::INFO));

        $info = [
            'user' => array_only($this->user->toArray(), $this->allowUserField),
            'model' => $this->model->toArray()
        ];

        $log->addInfo('action:'.$this->action, $info);
    }
}
