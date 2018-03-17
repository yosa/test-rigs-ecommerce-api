<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Logs extends Model
{
    
    protected $fillable = [
        'idUserCreated',
        'idEvent',
        'data',
    ];
    
    protected $casts = [
        'data'=>'json'
    ];
    
    public function user()
    {
        return $this->hasOne('App\Models\User', 'id', 'idUserCreated');
    }
    
    public function event()
    {
        return $this->hasOne('App\Models\Events', 'id', 'idEvent');
    }
    
    public function findEventKey($eventKey, array $data = [])
    {
        $query = $this
            ->join('events as e', 'e.id', '=', "$this->table.idEvent")
            ->where('e.key', $eventKey);
        
        if( empty($data)) {
            return $query->first();
        }
        
        foreach($data as $field=>$value) {
            $query = $query->whereRaw('JSON_EXTRACT(data, "$.'. $field . '") = ' . $value);
        }
        
        return $query->first();
    }
    
    public function withDetail()
    {
        return $this->with([
            'user',
            'event'
        ]);
    }
    
}
