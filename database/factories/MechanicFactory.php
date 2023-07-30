<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Mechanic;
use Faker\Generator as Faker;

$factory->define(Mechanic::class, function (Faker $faker) {
  return [
    'name' => $faker->name, 'address' => $faker->address
  ];
});
