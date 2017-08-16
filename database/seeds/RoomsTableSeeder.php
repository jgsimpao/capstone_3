<?php

use Illuminate\Database\Seeder;

class RoomsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$room_codes = ['201A', '201B', '202A', '202B',
    				  '201E', '201F', '202E', '202F'];
    	$capacity = 2;
    	$rate_night = 750.00;
    	$rate_week = 5000.00;
    	$rate_month = 20000.00;
    	$amenities = 'STANDARD B&B ROOM AMENITIES';

    	foreach($room_codes as $room_code) {
    		DB::table('rooms')->insert([ //,
	    		'room_code' => $room_code,
	    		'capacity' => $capacity,
	    		'rate_night' => $rate_night,
	    		'rate_week' => $rate_week,
	    		'rate_month' => $rate_month,
	    		'amenities' => $amenities
	    	]);
    	}
    }
}
