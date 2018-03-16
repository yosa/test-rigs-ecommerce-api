<?php

namespace App\Logics\Products;

use App\Logics\Products\UpdateLogic;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class LikesLogic extends UpdateLogic
{
    
    protected $eventSuccess = 'products.liked';
    
    public function save(&$input)
    {
        $result = $this->repository
            ->byId($input['id'])
            ->increment('likes');
        return $result === false ? false : $input['id'];
    }
    
}
