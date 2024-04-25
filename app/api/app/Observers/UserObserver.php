<?php

namespace App\Observers;

use App\Models\User;
use App\Notifications\NewUserNotification;
use App\Notifications\SmsNotification;

class UserObserver
{
    public function created(User $user): void
    {
        $user->notify(new SmsNotification());
        $user->notify(new NewUserNotification());
    }
}
