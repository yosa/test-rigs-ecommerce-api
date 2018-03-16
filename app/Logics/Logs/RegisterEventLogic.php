<?php

namespace App\Logics\Logs;

use App\Logics\LogicBusiness;
use App\Events\Event;
use App\Models\Logs;
use App\Models\Events;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class RegisterEventLogic
{
    use LogicBusiness;
    
    protected $repoLogs;
    protected $repoEvents;
    protected $identitySession;

    public function __construct(
        Logs $repoLogs, 
        Events $repoEvents
    )
    {        
        $this->repoLogs = $repoLogs;
        $this->repoEvents = $repoEvents;       
    }
    
    public function run(Event &$event)
    {
        $eventRecord = $this->getEvent($event->getKey());
        
        if( $eventRecord === false) {
            return false;
        }
        
        if( !$eventRecord) {
            $this->info('El evento no esta definido, se ignora registrar');
            return true;
        }
        
        $idUser = $this->getIdentity();
        
        $this->repoLogs->getConnection()->beginTransaction();
        
        $log = $this->createLog($idUser, $eventRecord, $event->getData());
        
        if( !$log) {            
            $this->repoLogs->getConnection()->rollBack();            
            return false;
        }        
        
        $this->repoLogs->getConnection()->commit();        
        return $this->getReturnData($log, $event);
    }
    
    public function getReturnData(&$log, $event)
    {
        return $log;
    }
    
    public function getEvent($key)
    {
        $result = $this->repoEvents->byKey($key)->first();
        
        if( !$result) {
            return $this->errorCode('log.1', [
                'eventKey'=>$key
            ]);
        }
        
        return $result;
    }
    
    public function createLog($idUser, $event, $data)
    {
        $result = $this->repoLogs->create([
            'idUserCreated'=>$idUser,
            'idEvent'=>$event->id,
            'data'=>$data
        ]);
        
        if( !$result) {
            return $this->errorCode('log.2', [
                'eventName'=>$event->name,
                'eventKey'=>$event->key,
            ]);
        }
        
        return $result;
    }
    
}
