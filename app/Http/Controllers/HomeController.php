<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Logics\Products\PaginLogic;
use App\Http\Requests\Products\PagingRequest;
use Faker\Generator as Faker;

class HomeController extends Controller
{
        
    public function index(
        PaginLogic $logic,
        PagingRequest $request
    )
    {
        $result = $logic->run($request->allValid());
        
        return view('welcome', [
            'products'=>json_decode(json_encode($result)),
            'faker'=>app(Faker::class)
        ]);
    }
    
}
