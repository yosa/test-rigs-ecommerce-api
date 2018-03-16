<?php

namespace App\Listeners;

use App\Logics\Logs\RegisterEventLogic;
use App\Events\Event;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class EventListener
{
    
    protected $logger;

    public function __construct(RegisterEventLogic $logger)
    {        
        $this->logger = $logger;        
    }
    
    public function handle(Event $event)
    {        
        return $this->logger->run($event);        
    }
    
}
