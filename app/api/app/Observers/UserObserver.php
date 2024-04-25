<?php

namespace App\Observers;

use App\Models\User;
use App\Notifications\SmsNotification;
use Illuminate\Support\Facades\Log;

class UserObserver
{
    public function created(User $user): void
    {
        $user->notify(new SmsNotification());
    }
}
