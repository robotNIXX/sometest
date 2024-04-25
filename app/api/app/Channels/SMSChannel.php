<?php

namespace App\Channels;

use App\Models\User;
use App\Services\InforuSMSService;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Log;

class SMSChannel
{
    public function send(User $notifiable, Notification $notification)
    {
        $message = $notification->toSMS($notifiable);

        if (config('external-apis.inforu.service_enabled') && $message && strlen($message) > 0 && $notifiable instanceof User) {
            $smsService = new InforuSMSService();
            $smsService->sendMessage($notifiable->phone, $message);
        }
    }
}