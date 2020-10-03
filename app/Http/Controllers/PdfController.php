<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\Product;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;

class PdfController extends Controller
{
    public function invoicedownload(){

        PDF::AddPage();
        PDF::writeHTML($this->invoice_data());
        PDF::Output('invoice.pdf');
    }

    public function invoice_data(){
    	$invoice_data = DB::table('invoices')
            ->join('products', 'invoices.productid', 'products.id')
            ->join('customers', 'invoices.customerid', 'customers.id')
            ->select('invoices.*', 'products.productname', 'customers.firstname')
            ->get();
        $output = '';
        foreach ($invoice_data as $invoice) {
        	$output .= '<h2>' . $invoice->productname . '</h2>';
        }
        return $output;
    }
}
