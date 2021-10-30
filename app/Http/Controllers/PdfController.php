<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Invoice;
use App\Models\Collection;
use PDF;

class PdfController extends Controller
{
    public function invoice($id){
        $data = [
            'invoice' => Invoice::with('customer', 'products')->where('id', $id)->first(),
        ];

        $pdf = PDF::loadView('downloads.invoice', $data, [], [ 'margin_top' => 0 ]);
        return $pdf->stream('invoice.pdf');
    }

    public function collection($id){
        $data = [
            'collection' => Collection::with('customer', 'created_by')->where('id', $id)->first(),
        ];

        $pdf = PDF::loadView('downloads.collection', $data, [], [ 'margin_top' => 0 ]);
        return $pdf->stream('collection.pdf');
    }
}