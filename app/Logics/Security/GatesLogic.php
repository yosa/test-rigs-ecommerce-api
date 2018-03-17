<?php

namespace App\Logics\Security;

use App\Logics\LogicBusiness;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class GatesLogic
{
    use LogicBusiness;
    
    /**
     * tables are usually consulted in database to validate the privilege. 
     * Due to the requirements of the test, it is not necessary to apply more.
     */
    public function run($gate)
    {
        $user = $this->getUser();
        
        if( !$user) {
            return $this->errorCode('sec.gate.1');
        }
        
        /* simple test is admin */
        if( $user->isAdmin) {
            return true;
        }
        
        return $this->errorCode('sec.gate.2', [
            'gate'=>$gate
        ]);
    }
    
}
