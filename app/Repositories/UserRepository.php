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

    // create or update from third party
    public function updateOrCreate($compareField, $data)
    {
        return User::UpdateOrCreate($compareField, $data);
    }


    // find user
    public function findData($fieldName, $fieldValue): User
    {
        $user = User::where($fieldName, $fieldValue)->first();

        if ($user) {
            return $user;
        }

        return NULL;
    }
}