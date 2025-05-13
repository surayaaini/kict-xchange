<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use App\Models\Proposal;
use Illuminate\Notifications\Messages\DatabaseMessage;

class MobilityApplicationPromptNotification extends Notification
{
    use Queueable;

    protected $proposal;

    public function __construct(Proposal $proposal)
    {
        $this->proposal = $proposal;
    }

    public function via($notifiable)
    {
        return ['database']; // stored in DB, shown in bell dropdown
    }

    public function toDatabase($notifiable)
    {
        return new DatabaseMessage([
            'message' => 'You have been invited to join a mobility programme with ' . $this->proposal->partner_university . '. Please complete the application form.',
            'proposal_id' => $this->proposal->id,
        ]);
    }
}
