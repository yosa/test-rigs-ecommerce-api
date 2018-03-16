<?php

use App\Fake\ProductsFake;
use App\Fake\ShoppingFake;

Artisan::command('fake-products', function() {
    app(ProductsFake::class)->run();
})->describe('Fake products');

Artisan::command('fake-shopping', function() {
    app(ShoppingFake::class)->run();
})->describe('Fake shopping');
