<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Reservation;
use App\Room;
use App\User;

class ReservationController extends Controller
{
    public function displayReservations() {
        $rooms = Room::getRooms();

        if(Auth::user()) {
            $user = User::find(Auth::user()->id);
            $user_application = $user->getApplication();

            if(!count($user_application)) {
                $user_application = collect([]);
                $stay_details = collect([]);
            }
            else {
                $stay_details = Reservation::getStayDetails($user_application);
            }
        }
        else {
            $user_application = collect([]);
            $stay_details = collect([]);
        }

        $pending_all = Reservation::getPending();
        $reserve_items = $pending_all;
        $list_pending = true;

        $approved_all = Reservation::getApproved();

        if(!count($approved_all)) {
            $rooms_available = $approved_all;
        }
        else {
            $rooms_available = [];

            foreach($rooms as $room) {
                $approved_room = $approved_all->where('room_id', $room->id);
                $available = false;

                if(!count($approved_room)) {
                    $available = true;
                }
                else {
                    if(!count( $approved_room->where('exclusive', 1)->first() )) {
                        if($approved_room->sum('persons') < $room->capacity) {
                            $available = true;
                        }
                    }
                }

                $rooms_available[$room->id] = $available;
            }
        }

    	return view('reserve', compact('rooms', 'user_application', 'reserve_items', 'list_pending', 'rooms_available', 'stay_details'));
    }

    public function displayStatus($id) {
        $room = Room::find($id);
        $approved_all = Reservation::getApproved();

        if(!count($approved_all)) {
            return response()->json([
                'id' => $room->id,
                'room_code' => $room->room_code,
                'capacity' => $room->capacity,
                'rate_night' => $room->rate_night,
                'rate_week' => $room->rate_week,
                'rate_month' => $room->rate_month,
                'available' => true,
                'occupants' => 0
            ]);
        }
        else {
            $approved_room = $approved_all->where('room_id', $room->id);
            $available = false;

            if(!count($approved_room)) {
                $available = true;
            }
            else {
                if(!count( $approved_room->where('exclusive', 1)->first() )) {
                    if($approved_room->sum('persons') < $room->capacity) {
                        $available = true;
                    }
                }
            }

            return response()->json([
                'id' => $room->id,
                'room_code' => $room->room_code,
                'capacity' => $room->capacity,
                'rate_night' => $room->rate_night,
                'rate_week' => $room->rate_week,
                'rate_month' => $room->rate_month,
                'available' => $available,
                'date_end' => $approved_room->sortByDesc('date_end')->first(),
                'occupants' => $approved_room->sum('persons'),
                'exclusive' => $approved_room->where('exclusive', 1)->first(),
                'approved_room' => $approved_room
            ]);
        }
    }

    public function addReserve($id, Request $request) {
        $validator = Validator::make($request->all(), [
            'persons' => 'required|numeric|min:1|max:10',
            'date_start' => 'required|date|after:today|before_or_equal:today +1 week',
            'date_end' => 'required|date|after_or_equal:tomorrow +3 month',
            'exclusive' => 'required|numeric|min:0|max:1'
        ]);

        if($validator->passes()) {
            $room = Room::find($id);
            $user = User::find(Auth::user()->id);

            $user->rooms()->attach($id, [
                'persons' => $request->persons,
                'date_start' => $request->date_start,
                'date_end' => $request->date_end,
                'exclusive' => $request->exclusive,
                'approved' => 0
            ]);

            return response()->json([
                'id' => $room->id,
                'room_code' => $room->room_code,
                'persons' => $request->persons,
                'date_start' => $request->date_start,
                'date_end' => $request->date_end,
                'exclusive' => $request->exclusive,
                'approved' => 0
            ]);
        }
        else {
            return response()->json($validator->errors()->all(), 422);
        }
    }

    public function approvePending($id, Request $request) {
        $room = Room::find($request->room_id);
        $approved_all = Reservation::getApproved();

        if(!count($approved_all)) {
            $available = true;
        }
        else {
            $approved_room = $approved_all->where('room_id', $request->room_id);
            $available = false;

            if(!count($approved_room)) {
                $available = true;
            }
            else {
                if(!count( $approved_room->where('exclusive', 1)->first() )) {
                    if($approved_room->sum('persons') < $room->capacity) {
                        $available = true;
                    }
                }
            }
        }

        if($available) {
            $reservation = Reservation::find($id);
            $reservation->approved = 1;
            $reservation->save();
        }
        else {
            return response()->json('Bedroom is unavailable. Cannot approve application.', 422);
        }
    }

    public function rejectPending($id, Request $request) {
        $reservation = Reservation::find($id);
        $reservation->delete();
    }

    public function deleteReserve($id, Request $request) {
        $reservation = Reservation::find($id);
        $reservation->delete();
    }
}
