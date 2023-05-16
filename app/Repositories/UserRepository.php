<?php

namespace App\Repositories;

use App\Repositories\baseCURD;
use App\Models\User;

class UserRepository extends baseCURD
{
    public function getModel()
    {
        return User::class;
    }

    // exists -> update, not exists -> create
    public function googleUpdateOrCreate($data): User
    {
        $user = User::updateOrCreate(
            [
                'email' => $data->email . '',
            ],
            [
                'name' => 'google-' . random_int(100000000, 999999999),
                'password' => uniqid('user-', true),
                'email' => $data->email . '',
                'google_id' => $data->id,
            ]
        );
        return $user;
    }
}
