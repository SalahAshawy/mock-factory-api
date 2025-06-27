<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MockEndpointResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'          => $this->id,
            'method'      => $this->method,
            'path'        => $this->path,
            'schema'      => $this->schema,
            'status_code' => $this->status_code,
            'delay_ms'    => $this->delay_ms,
            'created_at'  => $this->created_at->toDateTimeString(),
        ];
    }
}
