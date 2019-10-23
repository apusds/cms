<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Member;
use Faker\Generator as Faker;
use Faker\Factory as Local;



$factory->define(Member::class, function (Faker $faker) {
    $faker = Local::create('ms_MY');
    return [
        'email' => $faker->unique()->safeEmail,
        'name' => $faker->name,
        'mobile' =>$faker->phoneNumber,
        'student_id'=>$faker->regexify('^TP[0-9]{6}'),
        'gender'=> $faker->randomElement(['male', 'female']),
        'intake'=>$faker->regexify('^UC[\dDF]F\d{4}[A-Z][A-Z]'),
        'skills'=>$faker->randomElement([
            'Beginner',
            'Web Dev',
            'Backend',
            'Deployment',
            'Database',
        ]),
        'found_us'=>$faker->randomElement([
            'Facebook',
            'Heard from Friend',
            'Attended Event'
        ])
    ];
});
