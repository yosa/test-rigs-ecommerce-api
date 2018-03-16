<?php

namespace App\Logics;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
trait EventsTrait
{
    
    protected $eventSuccess = '';
        
    public function emitEventSuccess(&$data)
    {
        return true;
    }
    
    public function getDataEventSuccess($data)
    {
        return [
            'id'=>$data['record']->id
        ];
    }
    
}
