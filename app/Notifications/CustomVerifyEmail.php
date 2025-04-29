<?php

namespace App\Notifications;

use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Auth\Notifications\VerifyEmail as BaseVerifyEmail;

class CustomVerifyEmail extends BaseVerifyEmail
{
    /**
     * Build the mail representation of the notification.
     *
     * @param mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $verificationUrl = $this->verificationUrl($notifiable);

        return (new MailMessage)
            ->subject('Verify Your Email Address')
            ->greeting('Hello!')
            ->line('Please click the button below to verify your email address.')
            ->action('Verify Email', $verificationUrl)
            ->line('If you did not create an account, no further action is required.')
            ->salutation('Regards, DP Dahal COmpany');
    }
}
