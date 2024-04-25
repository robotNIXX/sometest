<?php

namespace App\Notifications;

use App\Channels\SMSChannel;
use App\Models\User;
use Illuminate\Notifications\Notification;

class SmsNotification extends Notification
{

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return [SMSChannel::class];
    }

    /**
     * @param User $notifiable
     *
     * @return string
     */
    public function toSMS(User $notifiable)
    {
        return "Glad to see in our system, {$notifiable->name}";
    }
}
