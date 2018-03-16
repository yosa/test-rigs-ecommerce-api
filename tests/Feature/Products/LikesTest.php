<?php

namespace Tests\Feature\Products;

use Tests\TestCase;
use App\Models\Products;

class LikesTest extends TestCase
{
    
    protected $url = 'api/v1/products';
    
    /**
     * @test
     * @group completed
     * @group products
     * @group products.likes
     * @group likes
     */
    public function invalid_input()
    {
        $response = $this
            ->withToken()
            ->json('put', "{$this->url}/9999999/likes");
        
        $this->responseWithErrors($response, 200);
    }

    /**
     * @test
     * @group completed
     * @group products
     * @group products.likes
     * @group likes
     */
    public function success()
    {
        $this->cleanLogs();
        $product = factory(Products::class)->create();
        
        $response = $this
            ->withToken()
            ->json('put', "{$this->url}/{$product->id}/likes");
        
        $changes = [
            'id'=>$product->id,
            'likes'=>$product->likes + 1
        ];
        $this->responseSuccess($response)
            ->eventInLog('products.liked', $changes);
        $this->assertDatabaseHas('products', $changes);
    }
    
}
