<?php

namespace Tests;

use App\Models\Logs;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
trait ResponseTrait
{
    
    public function cleanLogs()
    {
        Logs::where('id', '>', 1)->delete();
    }
    
    public function eventInLog($eventKey, array $data = [])
    {
        $logModel = app(Logs::class);
        $log = $logModel->findEventKey($eventKey, $data);
        $this->assertTrue(isset($log->id));
        return $this;
    }
    
    public function withErrorCode(&$response, $errorCode)
    {
        $result = collect(json_decode($response->getContent())->errors)
            ->where('code', $errorCode)
            ->first();
        $this->assertTrue($result->code === $errorCode);
        return $this;
    }
        
    public function responseWithErrors(&$response, $status = 400)
    {
        $response
            ->assertStatus($status)
            ->assertJson([
                'success'=>false
            ]);
        $json = json_decode($response->getContent());
        $this->assertTrue(isset($json->errors));
        foreach($json->errors as $error) {
            $this->assertTrue(isset($error->message));
        }
        return $this;
    }
    
    public function responseSuccess(&$response)
    {
        $response->assertJson([
            'success'=>true
        ]);
        return $this;
    }
    
    public function responseCreatedSuccess(&$response)
    {
        $response->assertStatus(201);
        $this->responseSuccess($response);
        $json = json_decode($response->getContent());
        $this->assertTrue(isset($json->data));
        $this->assertTrue(isset($json->data->id));
        return $this;
    }
    
    public function responsePagingSuccess(&$response)
    {
        $response->assertStatus(200);
        $this->responseSuccess($response);
        $json = json_decode($response->getContent());
        $this->assertTrue(isset($json->data));
        $this->assertTrue(isset($json->data->total));
        $this->assertTrue(isset($json->data->records));
        return $this;
    }
    
    public function responseUnauthenticated($endPoint)
    {
        $response = $this->post($endPoint);
        $this->responseRedirect($response);
        
        $responseAjax = $this
            ->withHeaders([
                'X-Requested-With'=>'XMLHttpRequest'
            ])
            ->post($endPoint);
        
        $this->responseWithErrors($responseAjax, 401);
    }
    
}
