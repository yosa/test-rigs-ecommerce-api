<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Logics\Products\PaginLogic;
use App\Logics\Products\CreateLogic;
use App\Http\Requests\Products\PagingRequest;
use App\Http\Requests\Products\CreateRequest;

class ProductsController extends Controller
{
    
    public function paging(
        PaginLogic $logic,
        PagingRequest $request
    )
    {
        $result = $logic->run($request->allValid());
        return response()->paging($result);
    }
    
    public function create(
        CreateRequest $request,
        CreateLogic $logic
    )
    {
        $result = $logic->run($request->allValid());
        return response()->create($result);
    }
    
}
