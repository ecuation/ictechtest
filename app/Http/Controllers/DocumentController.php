<?php

namespace App\Http\Controllers;

use App\Services\DocumentService;
use Illuminate\Http\Request;

class DocumentController extends Controller
{
    public function getDocumentsPerPriority()
    {
        $documents = (new DocumentService())->getDocumentsGroupedByPriority();
        return response()->json([
            'documents' => $documents
        ]);
    }
}
