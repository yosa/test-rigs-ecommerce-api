<?php

namespace App\Http\Requests\Security;

use App\Http\Requests\ApiRequest;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class LoginRequest extends ApiRequest
{
    
    protected $errorCode = [
        'email'=>'sec.login.1',
        'password'=>'sec.login.2',
        'clientId'=>'sec.login.3',
    ];
    protected $rules = [
        'email'=>'required|email',
        'password'=>'required',
        'clientId'=>'required',
    ];   
    
    protected function validationData()
    {
        $this->merge([
            'clientId'=>$this->header('client_id')
        ]);
        
        return parent::validationData();
    }
    
}
