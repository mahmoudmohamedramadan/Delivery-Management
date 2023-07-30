<?php

/** @var Factory $factory */

use App\Models\Delegate;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(Delegate::class, static function (Faker $faker) {
  return [
    'name'       => $faker->name, 'national_id' => $faker->randomNumber(),
    'phone'      => $faker->randomNumber(),
    'motor_size' => $faker->numberBetween(1500, 1600),
    'car_id'     => $faker->numerify('####'),
    'made_date'  => now()->diffForHumans()
  ];
});
