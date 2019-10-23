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
                'title' => 'APU Student Developer Society',
                'keyword' => null,
                'philosophy' => 'We strive to make the world a better place!',
                'about_us' => 'APU Student Developer Society was founded in 2015. Till then, we are still running.',
                'dsc_apu' => 'Developer Student Clubs (DSC)  is program presented by Google Developers. DSCs are university based community groups for students. Students from all undergraduate or graduate programs with an interest in growing as a developer are welcome. By joining a DSC, students grow their knowledge in a peer-to-peer learning environment and build solutions for local businesses and their community.',
                'announcement' => null,
                'created_at' => new DateTime()
            ]);

        Artisan::call('storage:link');

        $this->call([
            MembersTableSeeder::class,
        ]);
    }
}
