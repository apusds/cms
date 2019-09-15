<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\{ Hash, DB, Artisan };

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

        DB::table(env('DB_WEBSITE'))
            ->insert([
                'title' => 'APU SDS',
                'keyword' => null,
                'philosophy' => 'We strive to make the world a better place with Thanos JR',
                'about_us' => 'APU Student Developer Society was founded in 2015. Till then, we are still running.',
                'announcement' => null,
                'created_at' => new DateTime()
            ]);

        Artisan::call('storage:link');
    }
}
