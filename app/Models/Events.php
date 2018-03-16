<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Events extends Model
{
    
    protected $fillable = [
        'name',
        'key'
    ];
    public $timestamps = false;
    
    public function scopeByKey($query, $key)
    {
        return $query->where('key', $key);
    }
    
}
