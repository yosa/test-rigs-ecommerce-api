<?php

namespace App\Logics;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
trait BaseUpdateTrait
{
    
    public function beforeSave(&$input, &$event)
    {
        return $this->exists($input['id']);
    }
    
    public function exists($id)
    {
        $result = $this->repository->find($id);
        
        if( !$result) {
            return false;
        }
        
        return $result;
    }
    
    public function save(&$input)
    {
        $result = $this->getCriteria($input)
            ->update(
                array_only($input, $this->repository->getFillable())
            );
        
        if( $result === false) {
            return false;
        }
        
        if( isset($input['id'])) {
            return $input['id'];
        } else {            
            return is_numeric($result) ? $result : (isset($result->id) ? $result->id : $result) ;
        } 
    }
    
    public function getCriteria(&$input)
    {
        return $this->repository->where('id', $input['id']);
    }
    
}
