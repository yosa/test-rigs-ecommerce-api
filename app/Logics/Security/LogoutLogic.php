<?php

namespace App\Logics\Security;

use Illuminate\Support\Facades\DB;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class LogoutLogic
{
    
    public function __construct()
    {
        $this->cookie = app('cookie');
    }
    
    public function run()
    {
        $accessToken = app('auth')->user()->token();
        
        DB::table('oauth_refresh_tokens')
            ->where('access_token_id', $accessToken->id)
            ->update([
                'revoked'=>true
            ]);
        
        $accessToken->revoke();
        $this->cookie->queue($this->cookie->forget('refreshToken'));
    }
    
}
