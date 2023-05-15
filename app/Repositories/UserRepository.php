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

}