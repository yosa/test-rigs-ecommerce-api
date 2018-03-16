<?php

namespace App\Logics;

use App\Logics\LogicBusiness;
use App\Logics\EventsTrait;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class BaseCreateLogic
{
    use LogicBusiness;
    use EventsTrait;
    
    protected $repository;
    protected $idField = 'id';
    protected $fieldIdIdentityCreated = 'idUserCreated';
    protected $autoInyectIdentityCreated = true;
    protected $eventSuccess = '';
    protected $errorCode = '';

    public function __construct($repository)
    {        
        $this->repository = $repository;       
    }
    
    public function setIdField($id)
    {
        $this->idField = $id;
        return $this;
    }
    
    public function setStatusOk($status)
    {
        $this->statusOk = $status;
        return $this;
    }
    
    public function getIdField()
    {
        return $this->idField;
    }
    
    public function setAutoInyectIdentityCreated($autoInyect)
    {
        $this->autoInyectIdentityCreated = $autoInyect;
        return $this;
    }
    
    public function getAutoInyectIdentityCreated()
    {
        return $this->autoInyectIdentityCreated;
    }
    
    public function getIdentityCreated()
    {
        return $this->fieldIdIdentityCreated;
    }
    
    public function setIdentityCreated($field)
    {
        $this->fieldIdIdentityCreated = $field;
        return $this;
    }
    
    public function run(array $input)
    {
        $this->repository->getConnection()->beginTransaction(); 
        
        if( !$this->inyectIdIdentityCreated($input)) {
            return false;
        }
        
        if( !$this->isValidInput($input)) {
            return false;
        }
        
        $eventData = [];
        if( !$this->beforeSave($input, $eventData)) {
            return false;
        }
        
        $idRecord = $this->save($input);
        
        if( !$idRecord) {
            $this->repository->getConnection()->rollBack();
            return false;
        }
        
        $eventData = $this->getRecord($idRecord);
        
        if( !$eventData) {
            $this->error($this->getErrorCode());
            $this->repository->getConnection()->rollBack();
            return false;
        }
        
        $event = $this->emitEventSuccess($eventData);
        
        if( !$event) {
            $this->repository->getConnection()->rollBack();
            return false;
        }
        
        $this->repository->getConnection()->commit();
        return $this->getReturnData($input, $eventData, $event);
    }
    
    public function getReturnData(&$input, &$eventData, &$event)
    {
        return $eventData;
    }
    
    public function beforeSave(&$input, &$event)
    {
        return true;
    }
    
    public function isValidInput(&$input)
    {
        return true;
    }
    
    public function getRecord($id)
    {
        $result = $this->repository->find($id);
        
        if( !$result) {
            return false;
        }
        
        return $result;
    }
    
    public function getErrorCode()
    {
        return $this->errorCode;
    }
    
    public function inyectIdIdentityCreated(&$input)
    {        
        if( !$this->getAutoInyectIdentityCreated()) {
            return true;
        }
        
        $idIdentity = $this->getIdentity();
        
        if( !$idIdentity) {
            return false;
        }
        
        $input [$this->getIdentityCreated()]=  $idIdentity;
        return true;
    }
    
    public function save(&$input)
    {
        $result = $this->repository
            ->create(
                array_only($input, $this->repository->getFillable())
            );
        
        if( $result === false) {
            return false;
        }
        
        if( isset($input['id'])) {
            return $input['id'];
        } else {            
            return is_numeric($result) ? $result : (isset($result->id) ? $result->id : $result) ;
        }        
    }
    
}
