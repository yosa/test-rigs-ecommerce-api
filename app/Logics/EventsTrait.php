<?php

namespace App\Logics;

use App\Events\Event;

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
        if( empty($this->eventSuccess)) {
            $event = new Event('', $data);
            return $event;
        }
        
        $dataEvent = $this->getDataEventSuccess($data);
        $result = $this->fireEvent($this->eventSuccess, $dataEvent);
        
        if( !$result) {
            return false;
        }
        
        return $result;
    }
    
    public function getDataEventSuccess($data)
    {
        return $data->toArray();
    }
    
    public function fireEvent($key, &$data = null)
    {
        $event = new Event($key, $data);
        $result = event($event);
        return $this->isEventRunSuccess($event, $result);
    }
    
    public function isEventRunSuccess(&$event, &$result)
    {
        if( is_array($result)) {
            foreach ($result as $r) {
                if( is_bool($r) && !$r) {
                    return false;
                }
            }
            return $event;
        }
        
        if( in_array(false, $result)) {
            return false;
        }
        
        return $event;
    }
    
}
