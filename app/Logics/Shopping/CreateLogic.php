<?php

namespace App\Logics\Shopping;

use App\Logics\BaseCreateLogic;
use App\Models\Shopping;
use App\Models\Products;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class CreateLogic extends BaseCreateLogic
{
    
    protected $repoProducts;
    protected $product;

    public function __construct(
        Shopping $repository,
        Products $repoProducts
    )
    {
        parent::__construct($repository);
        $this->repoProducts = $repoProducts;
    }
    
    public function isValidInput(&$input)
    {
        $product = $this->getProduct($input['idProduct']);
                
        if( !$product) {
            return false;
        }
        
        if( !$this->inStock($product->stock, $input['quantity'])) {
            return false;
        }
        
        return true;
    }
    
    public function inStock($stock, $quantity)
    {
        if( $stock - $quantity > 0) {
            return true;
        }
        
        return $this->erroCode('a10');
    }
    
    public function save(&$input)
    {
        $result = parent::save($input);
        
        if( !$result) {
            return false;
        }
        
        if( $this->updateStock($input['idProduct'], $input['quantity'])) {
            return $result;
        }
        
        return false;
    }
    
    public function getProduct($idProduct)
    {
        $product = $this->repoProducts->getById($idProduct);
        
        if( $product) {
            return $product;
        }
        
        return $this->errorCode('a9');
    }
    
    public function updateStock($idProduct, $quantity)
    {
        $result = $this->repoProducts->updateStock($idProduct, $quantity);
        
        if( $result === false) {
            return $this->errorCode('a11');
        }
        
        return true;
    }
    
}
