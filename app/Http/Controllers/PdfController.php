<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Invoice;
use PDF;

class PdfController extends Controller
{
    public function invoicedownload($id){
        $data = [
            'invoice'            => Invoice::find($id),
        ];

        $pdf = PDF::loadView('downloads.invoice', $data, []);
        return $pdf->stream('invoice.pdf');
    }
}
