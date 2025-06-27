<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateProjectRequest;
use App\Actions\CreateProjectAction;
use App\Http\Resources\ProjectResource;
use Illuminate\Support\Facades\Auth;
use App\Models\MockProject;

class MockProjectController extends Controller
{
    public function store(CreateProjectRequest $request)
    {
        $project = CreateProjectAction::execute(
            $request->validated(),
            auth()->id()
        );

        return new ProjectResource($project);
    }
    public function index()
    {
        $projects = Auth::user()->projects()->with('endpoints')->get();

        return response()->json([
            'projects' => $projects
        ]);
    }
}
