<?php

use Faker\Generator as Faker;
use App\Models\Shopping;
use App\Models\User;
use App\Models\Products;

$factory->define(Shopping::class, function (Faker $faker) {
    $product = Products::inRandomOrder()->first();
    return [
        'idUserCreated'=>User::inRandomOrder()->first()->id,
        'idProduct'=>$product->id,
        'quantity'=>$faker->numberBetween(1, $product->stock),
    ];
});
