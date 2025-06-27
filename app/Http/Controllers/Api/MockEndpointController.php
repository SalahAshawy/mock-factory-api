<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateMockEndpointRequest;
use App\Http\Resources\MockEndpointResource;
use App\Models\MockProject;
use App\Actions\CreateMockEndpointAction;

class MockEndpointController extends Controller
{
    public function store(CreateMockEndpointRequest $request, MockProject $project)
    {
        $endpoint = CreateMockEndpointAction::execute($request->validated(), $project);

        return new MockEndpointResource($endpoint);
    }
}
