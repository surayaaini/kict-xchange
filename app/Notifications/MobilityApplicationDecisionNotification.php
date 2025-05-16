<?php

namespace App\Notifications;

use App\Models\MobilityApplication;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class MobilityApplicationDecisionNotification extends Notification
{
    use Queueable;

    protected $application;
    protected $decision; // 'approved' or 'rejected'

    /**
     * Create a new notification instance.
     */
    public function __construct(MobilityApplication $application, string $decision)
    {
        $this->application = $application;
        $this->decision = $decision;
    }

    /**
     * Get the notification's delivery channels.
     */
    public function via(object $notifiable): array
    {
        return ['database']; // You can add 'mail' if needed
    }

    /**
     * Get the array representation of the notification.
     */
    public function toArray(object $notifiable): array
    {
        return [
            'message' => $this->decision === 'approved'
                ? "Your mobility application to {$this->application->host_institution} has been approved."
                : "Your mobility application to {$this->application->host_institution} has been rejected.",
            'application_id' => $this->application->id,
            'decision' => $this->decision,
            'reason' => $this->application->admin_rejection_reason ?? null,
        ];
    }
}
