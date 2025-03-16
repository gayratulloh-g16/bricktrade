<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewCommentNotification extends Notification
{
    use Queueable;

    protected $comment;
    /**
     * Create a new notification instance.
     */
    public function __construct($comment)
    {
        $this->comment = $comment;
    }

    
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    
    

    
    public function toDatabase($notifiable)
    {
        return [
            'message' => 'A new comment has been added to the blog.',
            'comment_id' => $this->comment->id,
            'blog_id' => $this->comment->blog_id,
            'comment_text' => $this->comment->comment,
        ];
    }
}
