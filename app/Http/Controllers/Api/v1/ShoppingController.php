<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Logics\Shopping\CreateLogic;
use App\Http\Requests\Shopping\CreateRequest;

class ShoppingController extends Controller
{
    
    public function create(
        CreateRequest $request,
        CreateLogic $logic
    )
    {
        $result = $logic->run($request->allValid());
        return response()->create($result);
    }
        
}
