<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\ChangeHistory;

class KitExpiryReminder extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(public ChangeHistory $history)
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Kit Replacement Reminder')
            ->greeting('Hello '.$notifiable->name)
            ->line('One of your installed kits will expire in 5 days.')
            ->line('Replacement Date: '.$this->history->next_change_date)
            ->action('Login', url('/dashboard'))
            ->line('Please replace the kit before the expiration date.');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
