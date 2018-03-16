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
        'price'=>'a7',
    ];

    protected $rules = [
        'price'=>'required|numeric',
    ];
    
}
