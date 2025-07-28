<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;


class UserInfo extends Authenticatable
{
    use HasApiTokens, Notifiable, HasRoles;
    protected $table = 'user_infos';
    protected $fillable = [
        'user_name',
        'user_email',
        'user_password',
        'user_role',
    ];

    protected $hidden = [
        'user_password',
    ];

    // Use 'user_password' instead of default 'password'
    public function getAuthPassword()
    {
        return $this->user_password;
    }
}
