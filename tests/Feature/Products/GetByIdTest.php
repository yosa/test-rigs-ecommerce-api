<?php

namespace Tests\Feature\Products;

use Tests\TestCase;
use App\Models\Products;

class GetByIdTest extends TestCase
{
    
    protected $url = 'api/v1/products';
        
    /**
     * @test
     * @group completed
     * @group products
     * @group products.getById
     * @group getById
     */
    public function invalid_input()
    {
        $response = $this
            ->withToken()
            ->json('get', "{$this->url}/9999999");
        
        $this->responseWithErrors($response, 200);
    }

    /**
     * @test
     * @group completed
     * @group products
     * @group products.getById
     * @group getById
     */
    public function success()
    {
        $product = factory(Products::class)->create();
        
        $response = $this
            ->withToken()
            ->json('get', "{$this->url}/{$product->id}");
        
        $this->responseSuccess($response);
        $this->assertDatabaseHas('products', [
            'id'=>$product->id
        ]);
    }
    
}
