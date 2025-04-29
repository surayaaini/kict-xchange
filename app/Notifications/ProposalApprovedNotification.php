<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class ProposalApprovedNotification extends Notification
{
    use Queueable;

    public function via($notifiable)
    {
        return ['database']; // important: send to DB
    }

    public function toDatabase($notifiable)
    {
        return [
            'message' => 'Your mobility proposal has been approved!'
        ];
    }
}
