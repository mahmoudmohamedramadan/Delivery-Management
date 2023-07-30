<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Company;
use Faker\Generator as Faker;

$factory->define(Company::class, function (Faker $faker) {
  return [
    'name' => $faker->lexify('????????'), 'manager' => $faker->name, 'address' => $faker->lexify('?????????????'),
    'email' => $faker->unique()->safeEmail, 'phone' => $faker->numerify('###########'), 'product_name' => $faker->lexify('???????'), 'quantity' => $faker->randomDigitNotNull()
  ];
});
