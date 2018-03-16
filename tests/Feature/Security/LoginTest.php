<?php

namespace Tests\Feature\Security;

use Tests\TestCase;

class LoginTest extends TestCase
{
    
    protected $url = 'api/v1/security/login';
    
    /**
     * @test
     * @group completed
     * @group security
     * @group security.login
     */
    public function success()
    {
        $this->cleanLogs();
        
        $input = [
            'email'=>$this->getEmail(),
            'password'=>$this->getPassword(),
        ];
        $headers = [
            'client_id'=>$this->getClientId()
        ];
        
        $response = $this->post($this->url, $input, $headers);
        
        $this->responseSuccess($response);
        $result = json_decode($response->getContent());
        $this->assertTrue(isset($result->data->access_token));
        $this->assertTrue(isset($result->data->refresh_token));
        $this->assertTrue(isset($result->data->expires_in));
    }
    
}
