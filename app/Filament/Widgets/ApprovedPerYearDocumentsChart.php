<?php

namespace App\Filament\Widgets;

use App\Services\DocumentService;
use Filament\Widgets\ChartWidget;
class ApprovedPerYearDocumentsChart extends ChartWidget
{
    protected static ?string $heading = 'Chart';

    protected function getData(): array
    {
        $documents = (new DocumentService())->getApprovedDocumentsGroupedByMonth();
        $totals = $documents->map(fn ($document) => $document->total);

        return [
            'datasets' => [
                [
                    'label' => 'Blog posts created',
                    'data' => $totals->all(),
                ],
            ],
            'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
