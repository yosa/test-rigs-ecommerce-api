<?php

Route::prefix('v1')->group(function() {
    Route::get('products', 'ProductsController@paging');
});
