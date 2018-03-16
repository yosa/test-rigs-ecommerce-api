<?php

namespace App\Fake;

use App\Models\Products;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class ProductsFake
{
    
    public function run($items = 20)
    {
        return factory(Products::class, $items)->create();
    }
    
}
