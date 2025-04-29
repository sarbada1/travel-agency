<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use App\Models\User\Employer;

class EmployerCreatedNotification extends Notification
{
    use Queueable;

    public $company;

    /**
     * Create a new notification instance.
     */
    public function __construct(Employer $company)
    {
        $this->company = $company;
    }

    /**
     * Get the notification's delivery channels.
     */
    public function via($notifiable)
    {
        return ['mail', 'database']; // You can add other channels such as 'database' or 'slack'
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->line('A new company has been created: ' . $this->company->name)
            ->action('View Company', url('/companies/' . $this->company->id))
            ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     */

    public function toDatabase($notifiable)
    {
        return [
            'company_id' => $this->company->id,
            'company_name' => $this->company->name,
            'created_by' => auth()->user()->name
        ];
    }

}

