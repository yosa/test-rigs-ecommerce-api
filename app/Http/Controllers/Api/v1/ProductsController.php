<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Logics\Products\PaginLogic;
use App\Logics\Products\CreateLogic;
use App\Logics\Products\DeleteLogic;
use App\Logics\Products\UpdateLogic;
use App\Logics\Products\GetByIdLogic;
use App\Logics\Products\LikesLogic;
use App\Http\Requests\Products\PagingRequest;
use App\Http\Requests\Products\CreateRequest;
use App\Http\Requests\Products\UpdateRequest;

class ProductsController extends Controller
{
    
    public function create(
        CreateRequest $request,
        CreateLogic $logic
    )
    {
        $result = $logic->run($request->allValid());
        return response()->create($result);
    }
    
    public function readById(
        $id,
        GetByIdLogic $logic
    )
    {
        $result = $logic->run($id);
        return response()->data($result);
    }
    
    public function update(
        UpdateRequest $request,
        UpdateLogic $logic
    )
    {
        $result = $logic->run($request->allValid());
        return response()->data($result);
    }
    
    public function delete(
        $id,
        DeleteLogic $logic
    )
    {
        $result = $logic->run($id);
        return response()->delete($result);
    }
    
    public function likes(
        $id,
        LikesLogic $logic
    )
    {
        $result = $logic->run([
            'id'=>$id,
        ]);
        return response()->data($result);
    }
    
    public function paging(
        PaginLogic $logic,
        PagingRequest $request
    )
    {
        $result = $logic->run($request->allValid());
        return response()->paging($result);
    }
    
}
