<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class ParentLogin extends Authenticatable
{
    use Notifiable;

    protected $guard = 'parent';

    protected $fillable = [
        'name', 'email', 'mobile_no', 'username', 'address','password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
}
