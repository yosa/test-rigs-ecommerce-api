<?php

namespace App\Http\Requests\Products;

use App\Http\Requests\BasePagingRequest;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class PagingRequest extends BasePagingRequest
{
    
    public function rules()
    {
        $rules = parent::rules();
        $extraInput = [
            'sortable'=>'nullable|in:name,likes',
            'search'=>'nullable|max:100'
        ];
        return array_merge($rules, $extraInput);
    }
}
