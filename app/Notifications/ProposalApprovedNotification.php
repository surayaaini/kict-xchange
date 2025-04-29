<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\DatabaseMessage;
use Illuminate\Notifications\Notification;

class ProposalApprovedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct()
    {
        // You can pass in extra data if needed
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'message' => 'Your mobility proposal has been approved.',
            'url' => route('proposal.index'),
        ];
    }
}