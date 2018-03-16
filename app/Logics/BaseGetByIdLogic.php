<?php

namespace App\Logics;

use App\Logics\LogicBusiness;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class BaseGetByIdLogic
{
    use LogicBusiness;
    use EventsTrait;
    
    protected $repository;
    protected $errorCodeDoesNotExist;

    public function __construct($repository)
    {        
        $this->repository = $repository;       
    }
    
    public function run($id)
    {        
        $result = $this->exist($id);
        
        if( !$result) {
            return false;
        }
        
        $eventData = $result;
        $event = $this->emitEventSuccess($eventData);
        
        if( !$event) {
            return false;
        }
        
        return $this->getReturnData($result, $eventData, $event);
    }
    
    public function getReturnData(&$result, &$eventData, &$event)
    {
        return $result->toArray();
    }
    
    public function exist($id)
    {
        $result = $this->repository->find($id);
        
        if( !$result) {
            return $this->errorCode($this->getErrorCodeDoesNotExist());
        }
        
        return $result;
    }
    
    public function getErrorCodeDoesNotExist()
    {
        return $this->errorCodeDoesNotExist;
    }
    
    public function setErrorCodeDoesNotExist($errorCode)
    {
        $this->errorCodeDoesNotExist = $errorCode;
        return $this;
    }
    
}
