<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([ //,
    		'first_name' => 'Joel',
    		'last_name' => 'Simpao',
    		'phone' => '111-1111',
    		'email' => 'admin@kajoel.com',
    		'password' => bcrypt('123456'),
    		'role_id' => 1
    	]);
    }
}
