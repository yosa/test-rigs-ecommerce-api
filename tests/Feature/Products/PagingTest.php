<?php

namespace Tests\Feature\Prducts;

use Tests\TestCase;
use App\Models\Products;
use App\Fake\ProductsFake;

class PagingTest extends TestCase
{
    
    protected $url = 'api/v1/products';
    
    public function setUp()
    {
        parent::setUp();
        $this->cleanProductsTable();
    }
    
    
    /**
     * @test
     * @group completed
     * @group products.paging
     * @group paging
     */
    public function paging_limit()
    {
        /* fake products */
        app(ProductsFake::class)->run(5);
        
        $limits = [1, 2, 3, 4, 5];
        
        foreach($limits as $limit) {
            $input = [
                'limit'=>$limit
            ];
            $url = "{$this->url}?";
            $response = $this->get($url . http_build_query($input));

            $this->responseSuccess($response)
                ->responsePagingSuccess($response);
            $result = json_decode($response->getContent());
            $this->assertTrue(count($result->data->records) === $limit);   
        }
        
    }
       
    /**
     * @test
     * @group completed
     * @group products.paging
     * @group paging
     */
    public function search()
    {
        /* fake products with prefix search */
        factory(Products::class, 5)->states('prefixSearch')->create();
        
        $input = [
            'search'=>'Abc'
        ];
        $url = "{$this->url}?";
        
        $response = $this->get($url . http_build_query($input));
        
        $this->responseSuccess($response)
            ->responsePagingSuccess($response);
        
        $result = json_decode($response->getContent());
        $this->assertTrue(count($result->data->records) === 5);
    }
    
    /**
     * @test
     * @group completed
     * @group products.paging
     * @group paging
     */
    public function sortable_likes()
    {
        $this->createProductsTest();
        
        $input = [
            'sortable'=>'likes'
        ];
        $url = "{$this->url}?";
        
        $response = $this->get($url . http_build_query($input));
        
        $this->responseSuccess($response)
            ->responsePagingSuccess($response);
        
        $result = json_decode($response->getContent());
        
        $products = collect($result->data->records);
        $this->assertTrue($products->first()->likes === 9999);
    }

    /**
     * @test
     * @group completed
     * @group products.paging
     * @group paging
     */
    public function sortable_name()
    {
        $this->createProductsTest();
        
        $input = [
            'sortable'=>'name'
        ];
        $url = "{$this->url}?";
        
        $response = $this->get($url . http_build_query($input));
        
        $this->responseSuccess($response)
            ->responsePagingSuccess($response);
        
        $result = json_decode($response->getContent());
        
        $products = collect($result->data->records);
        $this->assertTrue($products->first()->name === 'aaa');
        $this->assertTrue($products->last()->name === 'zzz');
    }

    /**
     * @test
     * @group completed
     * @group products.paging
     * @group paging
     */
    public function paging()
    {
        $response = $this->get($this->url);
        $this->responseSuccess($response)
            ->responsePagingSuccess($response);
    }
    
    
    public function cleanProductsTable()
    {
        Products::where('id', '>', 0)->delete();
    }
    
    public function createProductsTest()
    {
        /* first delete */
        $productsName = [
            'aaa',
            'zzz',
        ];
        
        Products::whereIn('name', $productsName)->delete();
        
        /* create products */
        factory(Products::class)->create([
            'name'=>'aaa'
        ]);
        factory(Products::class)->create([
            'name'=>'zzz'
        ]);        
        
        factory(Products::class)->create([
            'likes'=>9999
        ]);
    }
    
}
