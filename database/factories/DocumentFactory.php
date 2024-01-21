<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Document>
 */
class DocumentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $file = fake()->file('/tmp', storage_path('app/public/documents'));
        $fileName = basename($file);
        $createdAt = fake()->dateTimeInInterval('-1 years', '+365 days');
        $approvedAt = (new Carbon($createdAt))->addDays(5);

        return [
            'name' => fake()->name(),
            'priority' => fake()->randomElement(['high', 'medium', 'low']),
            'approved_at' => $approvedAt,
            'file' => 'documents/' . $fileName,
            'created_at' => $createdAt,
            'updated_at' => $createdAt
        ];
    }
}
