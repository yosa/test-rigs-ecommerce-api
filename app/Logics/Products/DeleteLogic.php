<?php

namespace App\Logics\Products;

use App\Logics\BaseDeleteLogic;
use App\Models\Products;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class DeleteLogic extends BaseDeleteLogic
{
    
    protected $errorCodeDoesNotExist = 'a6';

    public function __construct(
        Products $repository
    )
    {
        parent::__construct($repository);
    }
    
}
