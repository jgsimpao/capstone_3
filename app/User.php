<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'phone', 'email', 'password', 'role_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function role() {
        return $this->belongsTo('App\Role');
    }

    public function rooms() {
        return $this->belongsToMany('App\Room', 'reservations')->withPivot('persons', 'date_start', 'date_end', 'exclusive', 'approved')->withTimestamps();
    }

    public function getApplication() {
        return $this->rooms()->wherePivotIn('approved', [0, 1])->latest()->first();
    }
}
