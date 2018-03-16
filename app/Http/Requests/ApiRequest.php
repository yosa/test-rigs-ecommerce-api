<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

abstract class ApiRequest extends FormRequest
{
    
    protected $rules = [];
    protected $errorCode = '';
    
    public function getErrorCode()
    {
        return $this->errorCode;
    }
    
    public function withValidator($validator)
    {
        $validator->errorCode = $this->getErrorCode();
    }
    
    public function rules()
    {
        return $this->rules;
    }
    
    public function authorize()
    {
        return true;
    }
    
    public function allValid()
    {        
        return $this->only(array_keys($this->rules()));        
    }
    
}
