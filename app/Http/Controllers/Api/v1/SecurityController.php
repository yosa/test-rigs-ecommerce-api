<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Logics\Security\LoginLogic;
use App\Logics\Security\LogoutLogic;
use App\Http\Requests\Security\LoginRequest;

class SecurityController extends Controller
{
    
    public function login(
        LoginLogic $logic,
        LoginRequest $request
    )
    {
        $result = $logic->run($request->allValid());
        return response()->data($result);
    }
    
    public function logout(
        LogoutLogic $logic
    )
    {
        $logic->run();
        return response()->json([
            'success'=>true
        ]);
    }
    
}
