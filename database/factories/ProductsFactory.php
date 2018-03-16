<?php

use Faker\Generator as Faker;
use App\Models\Products;

$factory->define(Products::class, function (Faker $faker) {
    return [
        'name'=>$faker->unique()->name,
        'npc'=>$faker->word,
        'stock'=>$faker->numberBetween(0, 999),
        'price'=>$faker->randomFloat(2, 0, 999),
        'likes'=>$faker->numberBetween(0, 999),
    ];
});

$factory->state(Products::class, 'prefixSearch', function ($faker) {
    return [
        'name'=>'Abc' . $faker->unique()->name
    ];
});
