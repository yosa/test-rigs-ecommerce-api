<?php

namespace App\Logics;

use App\Logics\LogicBusiness;
use App\Logics\EventsTrait;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class BasePagingLogic
{
    use LogicBusiness;
    use EventsTrait;
    
    protected $repository;
    protected $repositoryCriteria;

    public function __construct($repository)
    {        
        $this->repository = $repository;       
    }
    
    public function run(array $input)
    {
        $eventData = [];
        if( !$this->beforePaging($input, $eventData)) {
            return false;
        }
        
        $eventData ['records'] = $this->runQuery($input);
        
        if( (is_array($eventData['records']) && empty($eventData['records'])) || 
            $eventData['records']->total() === 0) {
            return [
                'total'=>0,
                'records'=>[],
            ];            
        }
        
        $event = $this->emitEventSuccess($eventData);
        
        if( !$event) {
            $this->repository->getConnection()->rollBack();
            return false;
        }
        
        return $this->getReturnData($input, $eventData, $event);
    }
    
    public function beforePaging(&$input, &$event)
    {
        return true;
    }
    
    public function getDataEventSuccess($data)
    {
        return [
            'totalRead'=>$data['records']->count()
        ];
    }
    
    public function getReturnData(&$input, &$eventData, &$event)
    {
        $data = [];
        $data ['total']= $eventData['records']->total();
        $data ['records']= $eventData['records']->toArray()['data']; 
        return $data;
    }
    
    public function runQuery(&$input)
    {
        if( is_null($this->repositoryCriteria)) {            
            $result = $this->repository->paginate((int)$input['limit']);            
        } else {            
            $result = $this->repository
                ->withCriteria($this->repositoryCriteria, $input)
                ->paginate((int)$input['limit']);
        }
        
        return $result;
    }
    
}
