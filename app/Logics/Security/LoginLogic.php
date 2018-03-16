<?php

namespace App\Logics\Security;

use App\Models\User;
use App\Models\OAuthClients;
use App\Logics\LogicBusiness;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class LoginLogic
{
    use LogicBusiness;
    
    protected $repoUsers;
    protected $repoOauthClients;
    protected $client;
    protected $cookie;
    
    public function __construct(
        User $repoUser,
        OAuthClients $repoOauthClients
    )
    {
        $this->repoUsers = $repoUser;
        $this->repoOauthClients = $repoOauthClients;
        
        $app = app();
        $this->cookie = $app->make('cookie');
        $this->apiConsumer = $app->make('apiconsumer');
    }
    
    public function run(array $input)
    {
        $user = $this->getUser($input['email']);
        
        if( !$user) {
            return false;
        }
        
        $client = $this->getClient($input['clientId']);
        
        if( !$client) {
            return false;
        }
        
        $result = $this->proxyLogin('password', $user, $client, $input['password']);
        
        if( !$result) {
            return false;
        }
        
        return $result;
    }
    
    public function getClient($id)
    {
        $result = $this->repoOauthClients->getById($id);
        
        if( $result) {
            return $result;
        }
        
        return $this->errorCode('sec.login.3');
    }
    
    public function proxyLogin($grantType, $user, $client, $password)
    {
        $params = array_merge([
            'username'=>$user->email,
            'password'=>$password,
        ], [
            'client_id'=>$client->id,
            'client_secret'=>$client->secret,
            'grant_type'=>$grantType
        ]);
        
        $response = $this->apiConsumer->post('/oauth/token', $params);
        
        if ( !$response->isSuccessful()) {
            return $this->errorCode('sec.login.2');
        }
        
        $result = json_decode($response->getContent());
        
        // Create a refresh token cookie
        $this->cookie->queue(
            'refreshToken',
            $result->refresh_token,
            864000,// 10 days
            null,
            null,
            false,
            true// HttpOnly
        );
        
        return [
            'access_token'=>$result->access_token,
            'expires_in'=>$result->expires_in,
            'refresh_token'=>$result->refresh_token,
            'user'=>$user->toArray()
        ];
    }
    
    public function getUser($email)
    {
        $user = $this->repoUsers->getByEmail($email);
        
        if ( is_null($user)) {
            return $this->errorCode('sec.login.1');
        }
        
        return $user;
    }
    
}
