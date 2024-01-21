<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;

class PriorityDocumentsChart extends ChartWidget
{
    protected static ?string $heading = 'Documents by priority';

    protected function getData(): array
    {
        return [
            'datasets' => [
                [
                    'label' => 'Documents by priority',
                    'data' => [3, 10, 5],
                ],
            ],
            'labels' => ['high', 'medium', 'low'],
        ];
    }

    protected function getType(): string
    {
        return 'pie';
    }
}
