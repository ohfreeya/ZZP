<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResetPassword extends Model
{
    use HasFactory;

    protected $fillable = [
        'email',
        'token',
        'account_id',
        'expires_at',
    ];

    public function getUser()
    {
        return $this->belongsTo(User::class, 'account_id', 'id');
    }
}