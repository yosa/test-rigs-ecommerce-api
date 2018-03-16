<?php

namespace App\Http\Requests\Products;

use App\Http\Requests\ApiRequest;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class CreateRequest extends ApiRequest
{
    
    protected $errorCode = [
        'name'=>'a1',
        'npc'=>'a2',
        'stock'=>'a3',
        'price'=>'a4',
    ];

    protected $rules = [
        'name'=>'required|max:100',
        'npc'=>'required|max:100',
        'stock'=>'required|numeric',
        'price'=>'required|numeric',
    ];
    
}
