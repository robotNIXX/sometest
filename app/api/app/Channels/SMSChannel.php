<?php

namespace App\Channels;

use App\Models\User;
use App\Services\InforuSMSService;
use Illuminate\Notifications\Notification;

class SMSChannel
{
    public function send(User $notifiable, Notification $notification)
    {
        $message = $notification->toSMS($notifiable);

        if (config('external-apis.inforu.service_enabled') && $message && strlen($message) > 0) {
            $smsService = new InforuSMSService();
            $smsService->sendMessage($notifiable->phone, $message);
        }
    }
}