<?php

namespace Database\Seeders;

use App\Models\Document;
use Illuminate\Database\Seeder;

class DocumentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Document::factory()
            ->count(30)
            ->create([
                'priority' => 'high'
            ]);

        Document::factory()
            ->count(15)
            ->create([
                'priority' => 'medium'
            ]);

        Document::factory()
            ->count(10)
            ->create([
                'priority' => 'low'
            ]);
    }
}
