<?php

namespace App\Logics;

use App\Logics\LogicBusiness;
use App\Logics\EventsTrait;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class BaseDeleteLogic
{
    use LogicBusiness;
    use EventsTrait;
    
    protected $repository;
    protected $errorCode;
    protected $errorCodeDoesNotExist;

    public function __construct($repository)
    {        
        $this->repository = $repository;       
    }
    
    public function run($id)
    {
        $this->repository->getConnection()->beginTransaction();
        
        if( !$this->exists($id)) {
            $this->errorCode($this->getErrorCodeDoesNotExist());
            $this->repository->getConnection()->rollBack();
            return false;
        }
        
        $eventData = [];
        if( !$this->beforeSave($id, $eventData)) {
            return false;
        }
        
        $result = $this->delete($id);
        
        if( !$result) {
            return $this->repository->getConnection()->rollBack();
        }
        
        $eventData ['id']= $id;
        $event = $this->emitEventSuccess($eventData);
        
        if( !$event) {
            $this->repository->getConnection()->rollBack();
            return false;
        }
        
        $this->repository->getConnection()->commit();
        return $this->getReturnData($id, $eventData, $event);
    }
    
    public function getDataEventSuccess($data)
    {
        return [
            'id'=>$data['id']
        ];
    }
    
    public function getReturnData(&$input, &$eventData, &$event)
    {
        return true;
    }
    
    public function beforeSave(&$input, &$event)
    {
        return true;
    }
    
    public function exists($id)
    {
        $result = $this->repository->find($id);
        
        if( !$result) {
            return false;
        }
        
        return $result;
    }
    
    public function getErrorCodeDoesNotExist()
    {
        return $this->errorCodeDoesNotExist;
    }
    
    public function getStatusError()
    {
        return $this->statusError;
    }
    
    public function setErrorCodeDoesNotExist($status)
    {
        $this->errorCodeDoesNotExist = $status;
        return $this;
    }
    
    public function delete($id)
    {
        $result = $this->repository->destroy($id);      
        
        if( $result === false) {
            return false;
        }
        
        return true;
    }
    
}
