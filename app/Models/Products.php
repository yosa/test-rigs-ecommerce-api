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
    
    protected $casts = [
        'stock'=>'integer',
        'likes'=>'integer',
        'price'=>'float',
    ];


    public function scopeById($query, $id)
    {
        return $query->where('id', $id);
    }
    
    public function scopeGetById($query, $id)
    {
        return $query
            ->byId($id)
            ->first(); 
    }
    
    public function scopeInStock($query, $id)
    {
        return $query
            ->byId($id)
            ->where('stock', '>', 0);
    }
    
    public function updateStock($idProduct, $quantity)
    {
        return $this
            ->where('id', $idProduct)
            ->update([
                'stock'=>$quantity
            ]);
    }
    
}
