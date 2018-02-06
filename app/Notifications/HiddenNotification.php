<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\Models\User;

class HiddenNotification extends Notification
{
    use Queueable;

    protected $model;

    protected $user;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($model, User $user)
    {
        $this->model = $model;
        $this->user  = $user;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toDatabase($notifiable)
    {
        return [
            'id'        => $this->user->id,
            'name'      => $this->user->name,
            'title'     => $this->model->title,
            'model_id'  => $this->model->id,
            'is_hidden' => $this->model->is_hidden,
        ];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
