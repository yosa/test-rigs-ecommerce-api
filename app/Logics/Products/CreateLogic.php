<?php

namespace App\Logics\Products;

use App\Logics\BaseCreateLogic;
use App\Models\Products;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class CreateLogic extends BaseCreateLogic
{
    
    public function __construct(
        Products $repository
    )
    {
        parent::__construct($repository);
    }
    
}
