<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\ResponseTrait;
use App\Models\User;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    use ResponseTrait;
    use DatabaseTransactions;
    
    public function getToken()
    {
        $token = User::where('email', env('TEST_USER_EMAIL'))
            ->first()
            ->createToken('test');
        
        return $token->accessToken;
    }
    
    public function withToken()
    {
        return $this->withHeaders([
            'Authorization'=>'Bearer ' . $this->getToken()
        ]);
    }
    
}
