<?php
namespace App\Services;

use Faker\Factory;

class FakeDataGenerator
{
    protected $faker;

    public function __construct()
    {
        $this->faker = Factory::create();
    }

    public function generate(array $schema): array
    {
        if (!isset($schema['type']) || $schema['type'] !== 'object' || !isset($schema['properties'])) {
            return [];
        }

        $result = [];

        foreach ($schema['properties'] as $key => $definition) {
            $result[$key] = $this->generateValueFromType($definition);
        }

        return $result;
    }

    protected function generateValueFromType(array $definition)
    {
        $type = $definition['type'] ?? 'string';

        return match ($type) {
            'string'  => $this->faker->name(),
            'integer' => $this->faker->numberBetween(1, 1000),
            'boolean' => $this->faker->boolean(),
            'number'  => $this->faker->randomFloat(2, 1, 100),
            'array'   => [], // You can expand this
            'object'  => [], // Nested objects can be handled recursively
            default   => null,
        };
    }
}
