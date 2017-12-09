<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

use App\Models\User;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class LoginLogSlug implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $user;

    protected $allowUserField = ['id', 'name', 'email', 'phone'];

    protected $action;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(User $user, $action)
    {
        $this->user   = $user;
        $this->action = $action;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $log = new Logger('loginLog');

        $path = storage_path('logs/loginLog.log');

        $log->pushHandler(new StreamHandler($path, Logger::INFO));

        $ip = \Request::ip();

        $info = [
            'user' => array_only($this->user->toArray(), $this->allowUserField)
        ];

        $log->addInfo('action:'.$this->action, array_add($info, 'ip', $ip));
    }
}
