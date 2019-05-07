<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use Laravel\Cashier\Billable;
use Illuminate\Contracts\Auth\CanResetPassword;


class User extends Authenticatable
{
    use Notifiable, HasRoles, Billable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function userLawInfo()
    {
        return $this->hasOne('App\UserLawInfo', 'user_id');
    }

    public function userLocation()
    {
        return $this->hasOne('App\UserLocation', 'user_id');
    }

    public function userSettings()
    {
        return $this->hasOne('App\UserSettings', 'user_id');
    }

    public function userSocialMedia()
    {
        return $this->hasOne('App\UserSocialMedia', 'user_id');
    }
}
