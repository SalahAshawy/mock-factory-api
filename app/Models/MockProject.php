<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Model;

class MockProject extends Model
{
    use Uuids;

    protected $fillable = ['name', 'token', 'user_id'];

    public function endpoints()
    {
        return $this->hasMany(MockEndpoint::class);
    }
    
    
}
