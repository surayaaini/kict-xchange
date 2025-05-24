<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class NewMobilityApplicationSubmitted extends Notification
{
    use Queueable;

    protected $studentName;
    protected $proposalTitle;
    protected $proposalId;

    public function __construct($studentName, $proposalTitle, $proposalId)
    {
        $this->studentName = $studentName;
        $this->proposalTitle = $proposalTitle;
        $this->proposalId = $proposalId;
    }

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toArray(object $notifiable): array
    {
        return [
            'title' => 'New Mobility Application Submitted',
            'message' => "{$this->studentName} has submitted a mobility application for '{$this->proposalTitle}'.",
            'proposal_id' => $this->proposalId,
        ];
    }
}
