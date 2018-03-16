<?php

use App\Fake\ProductsFake;

Artisan::command('fake', function() {
    app(ProductsFake::class)->run();
})->describe('Fake products');
