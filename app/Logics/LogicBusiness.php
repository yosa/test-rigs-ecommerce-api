<?php

namespace App\Logics;

use App\Events\Event;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
trait LogicBusiness
{
    
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
    
    public function isGod()
    {
        return app('isGod')->init();
    }
    
    public function isAllowedContentModel($privilege, $statusCode, $idContentModel)
    {
        return app('gates')->init($privilege, $statusCode, $idContentModel);
    }
    
    public function success($code, $data = [])
    {
        app('messages')->setStatusOk($code, $data);
        return true;
    }
    
    public function error($code, $data = [])
    {
        app('messages')->setStatusError($code, $data);
        return false;
    }
    
    public function info($code, $data = [])
    {
        return true;
    }
    
    public function getIdentity()
    {
        $user = request()->user();
        
        if( is_null($user)) {
            return $this->error('User Unauthenticated');
        }
        
        return $user->id;
    }
    
}
