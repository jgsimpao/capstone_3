<?php

use Illuminate\Database\Seeder;

class PicturesTableSeeder extends Seeder
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
    	$file_names = ['bed', 'side-1', 'side-2', 'side-3'];

    	foreach($room_codes as $index => $room_code) {
    		foreach($file_names as $file_name) {
    			$file_path = 'images/rooms/' . $room_code . '/' . $file_name . '.jpg';

	    		DB::table('pictures')->insert([ //,
		    		'file_path' => $file_path,
		    		'room_id' => $index + 1
		    	]);
    		}
    	}
    }
}
