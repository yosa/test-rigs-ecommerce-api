<?php

namespace App\Fake;

use App\Models\Shopping;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class ShoppingFake
{
    
    public function run($items = 20)
    {
        return factory(Shopping::class, $items)->create();
    }
    
}
