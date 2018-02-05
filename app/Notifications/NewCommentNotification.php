<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\Models\Comment;

class NewCommentNotification extends Notification
{
    use Queueable;

    protected $comment;

    protected $commentable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Comment $comment, $commentable)
    {
        $this->comment = $comment;
        $this->commentable = $commentable;
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
     * [toDatabase description]
     * @param  [type] $notifiable [description]
     * @return [type]             [description]
     */
    public function toDatabase($notifiable)
    {
        return [
            'id'             => user('api')->id,
            'name'           => user('api')->name,
            'bio'            => $this->comment->bio,
            'title'          => $this->commentable->title,
            'commentable_id' => $this->commentable->id,
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
            'id'             => user('api')->id,
            'name'           => user('api')->name,
            'bio'            => $this->comment->bio,
            'title'          => $this->commentable->title,
            'commentable_id' => $this->commentable->id,
        ];
    }
}
