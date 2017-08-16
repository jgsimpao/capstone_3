<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    public static function getRooms() {
        return Room::oldest('room_code')->get();
    }

    public function getPictures() {
    	return $this->pictures()->oldest()->get();
    }

    public function pictures() {
    	return $this->hasMany('App\Picture');
    }

    public function users() {
        return $this->belongsToMany('App\User', 'reservations')->withPivot('persons', 'date_start', 'date_end', 'exclusive', 'approved')->withTimestamps();
    }
}
