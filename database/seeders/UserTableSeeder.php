<?php

namespace Database\Seeders;

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
        \App\Models\User::factory(1)->create();

        $users = \App\Models\User::get();
        foreach ($users as $i => $user) 
        {
        	$user->assignRole('User');
        }
    }
}
