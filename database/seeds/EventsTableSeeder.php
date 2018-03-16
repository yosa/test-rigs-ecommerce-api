<?php

use Illuminate\Database\Seeder;
use App\Models\Events;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class EventsTableSeeder extends Seeder
{
    
    public function run()
    {
        Events::updateOrCreate([
            'name'=>'Product purchased',
            'key'=>'products.purchased'
        ], [
            'description'=>'A product has been purchased'
        ]);
        Events::updateOrCreate([
            'name'=>'Products liked',
            'key'=>'products.liked'
        ], [
            'description'=>'I liked a product'
        ]);
    }
    
}
