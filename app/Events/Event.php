<?php

namespace App\Events;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class Event
{
    
    protected $key;
    protected $data = null;
    protected $success = true;

    public function __construct($key, $data = null)
    {        
        $this->key = $key;
        $this->data = $data;        
    }
    
    public function getData()
    {        
        return $this->data;        
    }
    
    public function setData($data)
    {        
        $this->data = $data;
        return $this;
    }
    
    public function getKey()
    {        
        return $this->key;        
    }
    
    public function setError()
    {
        $this->success = false;
        return $this;
    }
    
    public function isSuccess()
    {
        return $this->success;
    }
    
}
