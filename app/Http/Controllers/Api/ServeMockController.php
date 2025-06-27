<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\MockProject;
use App\Services\FakeDataGenerator;
use Illuminate\Http\Request;

class   ServeMockController extends Controller
{
    public function __invoke(Request $request, string $token, string $path = '')
    {
        // 1. Find the project by token
        $project = MockProject::where('token', $token)->first();

        if (! $project) {
            return response()->json(['message' => 'Project not found'], 404);
        }

        // 2. Find the matching endpoint
        $endpoint = $project->endpoints()
            ->where('method', $request->method())
            ->where('path', $path)
            ->latest() // in case of multiple, get the last created
            ->first();

        if (! $endpoint) {
            return response()->json(['message' => 'Mock endpoint not found'], 404);
        }

        // 3. If response_body exists, return it
        if ($endpoint->response_body) {
            return response()->json($endpoint->response_body, $endpoint->status_code);
        }

        // 4. If no response_body, generate from schema
        $schema = $endpoint->schema ;

        if (!is_array($schema)) {
            return response()->json(['message' => 'Invalid schema format'], 400);
        }

        $fakeData = app(FakeDataGenerator::class)->generate($schema);

        return response()->json($fakeData, $endpoint->status_code ?? 200);
    }
}
