<?php

namespace Tests\Feature\Shopping;

use Tests\TestCase;
use App\Models\Products;

class CreateTest extends TestCase
{
    
    protected $url = 'api/v1/products';
    
    /**
     * @test
     * @group completed
     * @group shopping
     * @group shopping.create
     * @group create
     */
    public function success()
    {
        $this->cleanLogs();
        $product = factory(Products::class)->create();
        $quantity = rand(1, $product->stock ? $product->stock : 1);
        
        $response = $this
            ->withToken()
            ->json('put', "{$this->url}/{$product->id}/buy/$quantity");
        
        $this->responseSuccess($response)
            ->responseCreatedSuccess($response)
            ->eventInLog('products.purchased', [
                'idProduct'=>$product->id,
                'quantity'=>$quantity
            ]);
    }
    
}
