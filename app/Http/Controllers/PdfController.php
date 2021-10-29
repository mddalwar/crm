<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Exports\InvoiceExport;
use Maatwebsite\Excel\Facades\Excel;

class PdfController extends Controller
{
    public function invoicedownload($id){
        return Excel::download(new InvoiceExport, 'invoice.xlxs');
    }
}
