<?php

namespace Tests\Feature\Prducts;

use Tests\TestCase;
use App\Models\Products;

class DeleteTest extends TestCase
{
    
    protected $url = 'api/v1/products';
    
    /**
     * @test
     * @group completed
     * @group products
     * @group products.delete
     * @group delete
     */
    public function invalid_input()
    {
        $response = $this
            ->withToken()
            ->json('delete', "{$this->url}/9999999");
        
        $this->responseWithErrors($response, 200);
    }

    /**
     * @test
     * @group completed
     * @group products
     * @group products.delete
     * @group delete
     */
    public function success()
    {
        $product = factory(Products::class)->create();
        
        $response = $this
            ->withToken()
            ->json('delete', "{$this->url}/{$product->id}");
        
        $this->responseSuccess($response);
        $this->assertDatabaseMissing('products', [
            'id'=>$product->id
        ]);
    }
    
}
