<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\Logs;
use App\Logics\BasePagingLogic;
use App\Http\Requests\Logs\PagingRequest;

class LogsController extends Controller
{
    
    public function paging(
        Logs $repository,
        PagingRequest $request
    )
    {
        $query = $repository->withDetail();
        $logic = app(BasePagingLogic::class, [
            'repository'=>$query
        ]);
        $result = $logic->run($request->allValid());        
        return response()->paging($result);
    }
    
}
