<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Republic;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Republic::class, function (Faker $faker) {
    return [
    	'name' => $faker->name,
        'adress' => $faker->address,
        'price' => $faker->randomFloat($nbMaxDecimals = NULL, $min = 300, $max = 3000),
        'freeBedrooms' => $faker->randomDigit,
        'phone' => $faker->cellphone,
        'user_id' => factory('App\User')->create()->id,
    ];
});
