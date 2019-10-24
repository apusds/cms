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
        $user = new \App\User;
        $user->username = 'root';
        $user->email = 'studentdevelopersociety@gmail.com';
        $user->password = \Illuminate\Support\Facades\Hash::make('password');
        $user->role_id = 1;
        $user->save();
    }
}
