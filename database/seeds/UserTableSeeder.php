<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$userInti = \App\User::create([
    		'name' => 'Yoni Widhi', 
    		'role' => 'admin', 
    		'email' => 'admin@admin.com', 
    		'password' => bcrypt('thispassword')
    	]);

        $users = factory('App\User', 4)->create();
    }
}
