<?php

namespace App\Http\Requests\Shopping;

use App\Http\Requests\ApiRequest;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class CreateRequest extends ApiRequest
{
    
    protected $errorCode = [
        'idProduct'=>'a3',
        'quantity'=>'a4',
    ];

    protected $rules = [
        'idProduct'=>'required|numeric',
        'quantity'=>'required|numeric',
    ];
    
    protected function validationData()
    {
        $this->merge([
            'idProduct'=>$this->route('id'),
            'quantity'=>$this->route('quantity'),
        ]);
        return parent::validationData();
    }
    
}
