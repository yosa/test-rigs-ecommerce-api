<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class Products extends Model
{
    
    protected $fillable = [
        'name',
        'npc',
        'stock',
        'price',
        'likes'
    ];
    
}
