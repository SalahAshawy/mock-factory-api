<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Model;
class MockEndpoint extends Model
{
    use Uuids;

    protected $fillable = [
        'mock_project_id',
        'method',
        'path',
        'schema',
        'status_code',
        'delay_ms',
        'response_body'
    ];

    protected $casts = ['schema' => 'array', 'response_body' => 'array'];
    

    public function project()
    {
        return $this->belongsTo(MockProject::class);
    }
}
