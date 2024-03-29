<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class EmailVerificationNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(public int $otp)
    {
        $this->afterCommit();
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param \App\Models\User $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }
    
    /**
     * Get the mail representation of the notification.
     *
     * @param \App\Models\User $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     * @codeCoverageIgnore
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Please verify your email')
            ->greeting("Hi {$notifiable->first_name}")
            ->line('Please use the OTP below to verify your email address. Expires in next 10 minutes.')
            ->line("OTP: $this->otp")
            ->line('Thanks, IIARPUB');
    }
}