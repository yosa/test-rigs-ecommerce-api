<?php

Route::prefix('v1')->group(function() {
    Route::get('products', 'ProductsController@paging');
    Route::post('security/login', 'SecurityController@login');
    Route::get('logs', 'LogsController@paging');
});
