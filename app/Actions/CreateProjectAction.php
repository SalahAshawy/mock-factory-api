<?php
namespace App\Actions;

use App\Models\MockProject;
use Illuminate\Support\Str;

class CreateProjectAction
{
    public static function execute(array $data, ?int $userId): MockProject
    {
        return MockProject::create([
            'name' => $data['name'],
            'token' => Str::random(16),
            'user_id' => $userId,
        ]);
    }
}
