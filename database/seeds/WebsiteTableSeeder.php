<?php

use Illuminate\Database\Seeder;

class WebsiteTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $website = new \App\Website;
        $website->title = 'APU Student Developer Society';
        $website->keyword = 'cms, apusds';
        $website->philosophy = 'We strive to make the world a better place!';
        $website->about_us = 'APU Student Developer Society was founded in 2015. Till then, we are still running.';
        $website->dsc_apu = 'Developer Student Clubs (DSC)  is program presented by Google Developers. DSCs are university based community groups for students. Students from all undergraduate or graduate programs with an interest in growing as a developer are welcome. By joining a DSC, students grow their knowledge in a peer-to-peer learning environment and build solutions for local businesses and their community.';
        $website->announcement = null;
        $website->save();
    }
}
