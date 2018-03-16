<?php

namespace App\Http\Middleware;

use Closure;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class GatesSecurity
{
    
    public function handle($request, Closure $next, $gate = '*', $errorCode = '')
    {
        $user = $request->user();
        
        if (!$user) {
            return $this->cancelAction($request);
        }
        
        if( !app('gates')->run($gate, $errorCode, true)) {
            return response()->data(false);
        }
        
        return $next($request);        
    }
    
    public function cancelAction(&$request)
    {
        if($request->isJson() || $request->ajax()) {
            return response()->unauthenticated();
        }
        
        return redirect()->guest('login');
    }
    
}
