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
    protected $eventSuccess = 'products.purchased';

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
        $this->product = $this->getProduct($input['idProduct']);
                
        if( !$this->product) {
            return false;
        }
        
        if( !$this->inStock($input['quantity'])) {
            return false;
        }
        
        return true;
    }
    
    public function inStock($quantity)
    {
        if( $this->product->stock - (int)$quantity > 0) {
            return true;
        }
        
        return $this->errorCode('a10');
    }
    
    public function save(&$input)
    {
        $result = parent::save($input);
        
        if( !$result) {
            return false;
        }
        
        $newStock = $this->product->stock - (int)$input['quantity'];
        $this->info('stock: {s}, purchased: {q}, new stock: {n}', [
            's'=>$this->product->stock,
            'q'=>$input['quantity'],
            'n'=>$newStock,
        ]);
        
        if( $this->updateStock($input['idProduct'], $newStock)) {
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
