<?php

namespace App\Logics;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
trait LogicBusiness
{
    
    public function error($message, array $data = [])
    {        
        return app('messages')->error($message, $data);        
    }
    
    public function errorCode($code, array $data = [])
    {        
        return app('messages')->errorCode($code, $data);        
    }
    
    public function debug($message, array $data = [])
    {        
        return app('messages')->debug($message, $data);        
    }
    
    public function info($message, array $data = [])
    {        
        return app('messages')->info($message, $data);        
    }
    
    public function getUser()
    {
        return request()->user();
    }
    
    public function getIdentity()
    {
        $user = $this->getUser();
        
        if( is_null($user)) {
            return $this->error('User Unauthenticated');
        }
        
        return $user->id;
    }
    
}
