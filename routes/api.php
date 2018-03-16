<?php

Route::prefix('v1')->group(function() {
    Route::prefix('products')->group(function() {
        Route::post('/', 'ProductsController@create')
            ->middleware('gate:products.create');
        Route::get('{id}', 'ProductsController@readById');
        Route::put('{id}', 'ProductsController@update')
            ->middleware('gate:products.update');
        Route::put('{id}/likes', 'ProductsController@likes');
        Route::put('{id}/buy/{quantity}', 'ShoppingController@create');
        Route::delete('{id}', 'ProductsController@delete');
    });
});
