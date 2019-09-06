<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     */
    public function run()
    {
        DB::table(env('DB_ROLES'))
            ->insert([
                'name' => 'SuperAdmin',
                'created_at' => new DateTime()
            ]);

        DB::table(env("DB_USERS"))
            ->insert([
                'username' => 'root',
                'email' => 'studentdevelopersociety@gmail.com',
                'password' => Hash::make('password'),
                'role_id' => 1,
                'created_at' => new DateTime()
            ]);
    }
}
