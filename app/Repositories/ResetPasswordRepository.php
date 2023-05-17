<?php

namespace App\Repositories;

use App\Models\ResetPassword;
use  App\Repositories\baseCURD;

class ResetPasswordRepository  extends baseCURD{
    
    public function getModel()
    {
        return ResetPassword::class;
    }
} 