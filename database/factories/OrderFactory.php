<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Order;
use Faker\Generator as Faker;

$factory->define(Order::class, function (Faker $faker) {
  return [
    'delegate_id' => $faker->randomDigit(), 'shop_name' => $faker->lexify('??????'),
    'customer_address' => $faker->address, 'phone' => $faker->numerify('###########'),
    'order_fees' => $faker->randomFloat(), 'delivery_value' => $faker->randomFloat(),
    'delivery_date' => $faker->date()
  ];
});
