<?php

namespace App\Logics\Products;

use App\Logics\BasePagingLogic;
use App\Models\Products;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class PaginLogic extends BasePagingLogic
{
    
    public function __construct(
        Products $repository
    )
    {
        parent::__construct($repository);
    }
    
    public function runQuery(&$input)
    {
        if( isset($input['sortable'])) {
            $order = $input['sortable'] === 'likes' ? 'DESC' : 'ASC';
            $this->repository = $this->repository
                ->orderBy($input['sortable'], $order);
        } else {
            $this->repository = $this->repository->orderBy('name');
        }
        
        if( isset($input['search'])) {
            $this->repository = $this->repository
                ->where('name', 'like', "%{$input['search']}%");
        }
        
        return parent::runQuery($input);
    }
    
}
