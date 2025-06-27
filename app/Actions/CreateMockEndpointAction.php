<?php
namespace App\Actions;

use App\Models\MockProject;
use App\Models\MockEndpoint;
use Illuminate\Validation\ValidationException;

class CreateMockEndpointAction
{
    public static function execute(array $data, MockProject $project): MockEndpoint
    {
        // Check if an endpoint with same method and path already exists for this project
        $existing = $project->endpoints()
            ->where('method', strtoupper($data['method']))
            ->where('path', $data['path'])
            ->first();

        if ($existing) {
            throw ValidationException::withMessages([
                'endpoint' => ['An endpoint with this method and path already exists.'],
            ]);
        }

        // Create new endpoint
        return $project->endpoints()->create([
            'method'        => strtoupper($data['method']),
            'path'          => $data['path'],
            'schema'        => $data['schema'],
            'status_code'   => $data['status_code'] ?? 200,
            'delay_ms'      => $data['delay_ms'] ?? 0,
            'response_body' => $data['response_body']??"",
        ]);
    }
}
