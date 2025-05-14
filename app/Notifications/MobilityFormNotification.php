<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\DatabaseMessage;

class MobilityFormNotification extends Notification
{
    use Queueable;

    public $proposalId;

    public function __construct($proposalId)
    {
        $this->proposalId = $proposalId;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'message' => 'You have been invited to apply for a mobility programme. Please fill in the application form.',
            'proposal_id' => $this->proposalId,
        ];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->line('You have been invited to apply for a mobility programme.')
            ->action('Apply Now', route('mobility.index'))
            ->line('Thank you for using MYKICT!');
    }

}
