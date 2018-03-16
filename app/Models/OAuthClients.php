<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OAuthClients extends Model
{
    
    protected $table = 'oauth_clients';

    public function getById($id)
    {
        return $this->where('id', $id)->first();
    }
    
}
