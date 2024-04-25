<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersService
{
    /**
     * @param array $data
     *
     * @return User
     */
    public function create(array $data): User
    {
        $data['password'] = Hash::make('password');
        $user = User::create($data);
        $user->phone()->create([
            'phone' => $data['idd'] . $data['phone']
        ]);
        $user->country()->create([
            'country_name' => $data['country']
        ]);

        return $user;
    }
}