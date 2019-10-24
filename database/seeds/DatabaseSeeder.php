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
        $this->call([
            RolesTableSeeder::class,
            UsersTableSeeder::class,
            WebsiteTableSeeder::class,
            MembersTableSeeder::class,
        ]);

        Artisan::call('storage:link');
    }
}
