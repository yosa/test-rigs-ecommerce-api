<?php

namespace App\Http\Requests;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class BasePagingRequest extends ApiRequest
{
    
    public function rules()
    {
        return [
            'page'=>'required|numeric',
            'start'=>'required|numeric',
            'limit'=>'required|numeric',
        ];
    }
    
    protected function validationData()
    {
        $page = $this->get('page');
        $start = $this->get('start');
        $limit = $this->get('limit');
        
        $this->merge([
            'page'=>$page ? $page : 1,
            'start'=>$start ? $start : 1,
            'limit'=>$limit ? $limit : 50,
        ]);
        
        return parent::validationData();
    }
    
}
