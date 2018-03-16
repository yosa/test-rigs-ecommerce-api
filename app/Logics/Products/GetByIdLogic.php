<?php

namespace App\Logics\Products;

use App\Logics\BaseGetByIdLogic;
use App\Models\Products;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class GetByIdLogic extends BaseGetByIdLogic
{
    
    protected $errorCodeDoesNotExist = 'a8';

    public function __construct(Products $repository)
    {
        parent::__construct($repository);
    }
    
}
