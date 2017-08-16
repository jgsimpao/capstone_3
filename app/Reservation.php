<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DateTime;

class Reservation extends Model
{
    public static function getReservations() {
        return Reservation::join('users', 'reservations.user_id', 'users.id')->join('rooms', 'reservations.room_id', 'rooms.id')->select('reservations.id as reservation_id', 'reservations.*', 'users.*', 'rooms.*')->latest('reservations.created_at')->get();
    }

    public static function getPending() {
        $reservations = Reservation::getReservations();

        if($reservations->isEmpty()) {
            return $reservations;
        }
        else {
            return $reservations->where('approved', 0)->where('date_start', '>=', date('Y-m-d'));
        }
    }

    public static function getApproved() {
        $reservations = Reservation::getReservations();

        if($reservations->isEmpty()) {
            return $reservations;
        }
        else {
            return $reservations->where('approved', 1)->where('date_end', '>=', date('Y-m-d'));
        }
    }

    public static function getStayDetails($user_application) {
        $date_start = $user_application->pivot->date_start;
        $date_end = $user_application->pivot->date_end;

        $rate_night = $user_application->rate_night;
        $rate_week = $user_application->rate_week;
        $rate_month = $user_application->rate_month;

        $datetime1 = new DateTime($date_start);
        $datetime2 = new DateTime($date_end);
        $interval = $datetime1->diff($datetime2);
        $days = $interval->format('%a');
        $total_days = $days;

        $fee = 0;
        $months = (int)($days / 28);
        $fee += $months * $rate_month;

        $days = $days % 28;
        $weeks = (int)($days / 7);
        $fee += $weeks * $rate_week;

        $days = $days % 7;
        $fee += $days * $rate_night;
        $total_fee = "&#8369; " . number_format($fee, 2, '.', ',');

        return ['total_days' => $total_days, 'total_fee' => $total_fee];
    }
}
