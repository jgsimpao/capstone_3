<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Room;

class RoomController extends Controller
{
    public function displayRooms() {
    	$rooms = Room::getRooms();

    	return view('rooms', compact('rooms'));
    }

    public function displayDetails($id) {
    	$room = Room::find($id);
    	$pictures = $room->getPictures();
        $pic_arr = [];

        foreach($pictures as $picture) {
            $pic_arr[] = [
                'id' => $picture->id,
                'file_path' => $picture->file_path,
                'room_id' => $picture->room_id
            ];
        }

    	return response()->json([
    		'room' => [
    			'id' => $room->id,
    			'room_code' => $room->room_code,
    			'capacity' => $room->capacity,
    			'rate_night' => $room->rate_night,
                'rate_week' => $room->rate_week,
                'rate_month' => $room->rate_month,
    			'amenities' => $room->amenities
    		],
    		'pictures' => $pic_arr
    	]);
    }

    public function editDetails($id, Request $request) {
        $validator = Validator::make($request->all(), [
            'capacity' => 'required|numeric|min:1|max:10',
            'rate_night' => 'required|numeric|min:1|regex:/^\d*(\.\d{1,2})?$/',
            'rate_week' => 'required|numeric|min:1|regex:/^\d*(\.\d{1,2})?$/',
            'rate_month' => 'required|numeric|min:1|regex:/^\d*(\.\d{1,2})?$/',
            'amenities' => 'required|string|min:10'
        ]);

        if($validator->passes()) {
            $room = Room::find($id);

            $room->capacity = $request->capacity;
            $room->rate_night = $request->rate_night;
            $room->rate_week = $request->rate_week;
            $room->rate_month = $request->rate_month;
            $room->amenities = $request->amenities;

            $room->save();

            return response()->json([
                'capacity' => $room->capacity,
                'rate_night' => $room->rate_night,
                'rate_week' => $room->rate_week,
                'rate_month' => $room->rate_month,
                'amenities' => $room->amenities
            ]);
        }
        else {
            return response()->json($validator->errors()->all(), 422);
        }
    }
}
