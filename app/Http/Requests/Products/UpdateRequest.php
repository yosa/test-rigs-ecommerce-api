<?php

namespace App\Http\Requests\Products;

use App\Http\Requests\ApiRequest;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class UpdateRequest extends ApiRequest
{
    
    protected $errorCode = [
        'id'=>'a7',
        'price'=>'a8',
    ];

    protected $rules = [
        'id'=>'required|numeric',
        'price'=>'required|numeric',
    ];
    
    protected function validationData()
    {
        $this->merge([
            'id'=>$this->route('id'),
        ]);
        return parent::validationData();
    }
    
}
