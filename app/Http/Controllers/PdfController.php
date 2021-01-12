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
    public function invoicedownload($id){

        $invoice = Invoice::find($id);
        $invproducts = DB::table('invproducts')->where('invoice', $id)->get();

        $table = '<table cellspacing="0" cellpadding="3" border="1" style="width: 100%; margin-top: 300px;"><tr><td>To, <br />' . customer_name($invoice->customer) . '<br />' . customer_address($invoice->customer) . '<br /> Phone:- ' . customer_phone($invoice->customer) . '<br />' . customer_email($invoice->customer) . '</td><td>Invoice Information: <br /> Invoice No:- INV00' . $invoice->id . '<br /> Create Date:- ' . $invoice->created_at . '</td></tr></table><table border="1" style="width: 100%; margin-top: 100px;"><tr><th>SL No</th><th>Product Name</th><th> Quantity</th><th>Unit Price</th><th>Subtotal</th></tr>';
        $sl = 1;
        foreach ($invproducts as $product) {
            $table .= '<tr><td>' . $sl . '</td><td>' . product_name($product->product) . '</td><td>' . $product->price . ' ' . product_unit($product->product) . '</td><td>' . $product->price . ' ' . currency() . '</td><td>' . $product->total . ' ' . currency() . ' Taka</td></tr>';
            $sl++;
        }

        $table .= '</table>';

        PDF::SetTitle('Invoice');
        PDF::AddPage();
        PDF::writeHTML($table, true, false, false, false, '');
        PDF::Output('invoice.pdf', 'D');
    }
}
