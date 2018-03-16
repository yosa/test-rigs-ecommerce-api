<?php

Route::prefix('v1')->group(function() {
    Route::post('products', 'ProductsController@create');
});
