<?php

namespace App\Filament\Widgets;

use App\Services\DocumentService;
use Filament\Widgets\ChartWidget;

class PriorityDocumentsChart extends ChartWidget
{
    protected static ?string $heading = 'Documents by priority';

    protected function getData(): array
    {
        $documents = (new DocumentService())->getDocumentsGroupedByPriority();

        $high = $documents->filter(fn($document) => $document->priority === 'high')->first();
        $medium = $documents->filter(fn($document) => $document->priority === 'medium')->first();
        $low = $documents->filter(fn($document) => $document->priority === 'low')->first();

        return [
            'datasets' => [
                [
                    'label' => 'Documents by priority',
                    'data' => [$high->total, $medium->total, $low->total],
                ],
            ],
            'labels' => [$high->priority, $medium->priority, $low->priority],
        ];
    }

    protected function getType(): string
    {
        return 'pie';
    }
}
