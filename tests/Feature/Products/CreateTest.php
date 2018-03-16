<?php

namespace Tests\Feature\Prducts;

use Tests\TestCase;
use App\Models\Products;

class CreateTest extends TestCase
{
    
    protected $url = 'api/v1/products';
    
    /**
     * @test
     * @group completed
     * @group products
     * @group products.create
     * @group create
     */
    public function invalid_input()
    {
        $inputCases = [
            [],
            [
                'name'=>'testName',
            ],
            [
                'name'=>'test name',
                'npc'=>'test npc',
            ],
            [
                'name'=>'test name',
                'npc'=>'test npc',
                'price'=>1,
            ],
            [
                'name'=>'test name',
                'npc'=>'test npc',
                'stock'=>1,
            ],
            [
                'name'=>'test name',
                'npc'=>'test npc',
                'price'=>1,
            ],
        ];
        
        foreach($inputCases as $input) {
            $response = $this
                ->withToken()
                ->json('post', $this->url, $input);

            $this->responseWithErrors($response, 422);
        }
    }

    /**
     * @test
     * @group completed
     * @group products
     * @group products.create
     * @group create
     */
    public function success()
    {
        $input = factory(Products::class)->make()->toArray();
        
        $response = $this
            ->withToken()
            ->json('post', $this->url, $input);
        
        $this->responseSuccess($response)
            ->responseCreatedSuccess($response);
    }
    
}
