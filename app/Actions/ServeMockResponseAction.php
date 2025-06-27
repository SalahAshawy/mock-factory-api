<?php
namespace App\Actions;

use App\Models\MockProject;
use App\Models\MockEndpoint;
use App\Services\FakeDataGenerator;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ServeMockResponseAction
{
    public static function execute(string $token, string $path, string $method): array
    {
        $project = MockProject::where('token', $token)->first();

        if (!$project) {
            throw new NotFoundHttpException('Mock project not found.');
        }

        $endpoint = $project->endpoints()
            ->where('method', strtoupper($method))
            ->where('path', $path)
            ->first();

        if (!$endpoint) {
            throw new NotFoundHttpException('Mock endpoint not found.');
        }

        $fakerService = new FakeDataGenerator();
        $data = $fakerService->generate($endpoint->schema);

        return [
            'status_code' => $endpoint->status_code,
            'delay_ms'    => $endpoint->delay_ms,
            'data'        => $data,
        ];
    }
}
