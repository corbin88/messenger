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

        App\User::Create(['name' => 'kyle','email' => 'kyle@example.com', 'password' => bcrypt('password')]);

    	App\User::Create(['name' => 'corbin', 'email' => 'corbin@example.com', 'password' => bcrypt('password')]);

        App\User::Create(['name' => 'jeff', 'email' => 'jeff@example.com', 'password' => bcrypt('password')]);

        App\User::Create(['name' => 'bill', 'email' => 'bill@example.com', 'password' => bcrypt('password')]);
        //factory('App\User',20)->create();
    }
}
