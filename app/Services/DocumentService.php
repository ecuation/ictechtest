<?php

namespace App\Services;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class DocumentService
{
    public function getApprovedDocumentsGroupedByMonth(): Collection
    {
        $documents =  DB::table('documents')
            ->select(DB::raw('count(id) as `total`'), DB::raw("YEAR(created_at) year"),  DB::raw('MONTH(created_at) month'))
            ->whereYear('created_at', now()->subYear()->year)
            ->whereNotNull('approved_at')
            ->groupby('month')
            ->orderBy('month')
            ->get();

        return $documents;
    }

    public function getDocumentsGroupedByPriority(): Collection
    {
        $documents = DB::table('documents')
            ->select('priority', DB::raw('count(*) as total'))
            ->groupBy('priority')
            ->get();

        return $documents;
    }
}
