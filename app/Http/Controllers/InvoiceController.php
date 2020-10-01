<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invoice;
use App\Models\Product;
use App\Models\Customer;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $invoices = Invoice::all();
        return view('invoices.index', compact('invoices'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::all();
        $customers = Customer::all();

        return view('invoices.create', compact('products', 'customers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $all_data = $request->all();

        $invoice_data = [
            'productid'         => $all_data['productid'],
            'customerid'        => $all_data['customerid'],
            'sellquantity'      => $all_data['sellquantity'],
            'totalamount'       => $all_data['totalamount'],
            'discount'          => isset($all_data['discount']) ? $all_data['discount'] : 0,
            'paid'              => isset($all_data['paid']) ? $all_data['paid'] : 0,
            'note'              => $all_data['note']
        ];

        $validate_rule = [
            'productid'         => 'required',
            'customerid'        => 'required',
            'sellquantity'      => 'required',
            'totalamount'       => 'required',
            'discount'          => 'required',
            'paid'              => 'required',
            'note'              => 'nullable'
        ];
        $error_message = [
            'productid.required'         => 'You have to select a product !',
            'customerid.required'        => 'You have to select a product !',
            'sellquantity.required'      => 'Sell qunatity is required !',
            'totalamount.required'       => 'Sell qunatity is required !',
            'discount.required'          => 'Invalid discount amount !',
            'paid.required'              => 'Invalid paid amount !'
        ];
        Validator::make($invoice_data, $validate_rule, $error_message)->validate();

        $invoice_due = $all_data['totalamount'] - $all_data['discount'] - $all_data['paid'];
        $due = [
            'due' => $invoice_due
        ];

        $final_data = array_merge($invoice_data, $due);

        // Update Product Stock
        $product = DB::table('products')->where('id', $all_data['productid'])->first();
        $customer = DB::table('customers')->where('id', $all_data['customerid'])->first();

        $update_stock = [
            'stock'     => $product->stock - $all_data['sellquantity']
        ];
        $customer_due = [
            'due'     => $customer->due + $invoice_due
        ];
        
        // Customer and Product Update
        $product_stock_update = DB::table('products')->where('id', $all_data['productid'])->update($update_stock);
        $customer_due_update = DB::table('customers')->where('id', $all_data['customerid'])->update($customer_due);

        if(isset($product_stock_update) && isset($customer_due_update)){
            // Create Invoice
            $invoice = Invoice::create($final_data);

            return redirect()->route('invoices.show', $invoice->id);
        }
                

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $invoice = Invoice::find($id);
        $product = Product::find($invoice->productid);
        $customer = Customer::find($invoice->customerid);
        return view('invoices.invoice', compact('invoice', 'product', 'customer'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $products = Product::all();
        $customers = Customer::all();
        $invoice = Invoice::find($id);
        return view('invoices.edit', compact('invoice', 'products', 'customers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $all_data = $request->all();

        $invoice_data = [
            'productid'         => $all_data['productid'],
            'customerid'        => $all_data['customerid'],
            'sellquantity'      => $all_data['sellquantity'],
            'totalamount'       => $all_data['totalamount'],
            'discount'          => isset($all_data['discount']) ? $all_data['discount'] : 0,
            'paid'              => isset($all_data['paid']) ? $all_data['paid'] : 0,
            'note'              => $all_data['note']
        ];

        $validate_rule = [
            'productid'         => 'required',
            'customerid'        => 'required',
            'sellquantity'      => 'required',
            'totalamount'       => 'required',
            'discount'          => 'required',
            'paid'              => 'required',
            'note'              => 'nullable'
        ];
        $error_message = [
            'productid.required'         => 'You have to select a product !',
            'customerid.required'        => 'You have to select a product !',
            'sellquantity.required'      => 'Sell qunatity is required !',
            'totalamount.required'       => 'Sell qunatity is required !',
            'discount.required'          => 'Invalid discount amount !',
            'paid.required'              => 'Invalid paid amount !'
        ];
        Validator::make($invoice_data, $validate_rule, $error_message)->validate();

        $due = [
            'due' => $all_data['totalamount'] - $all_data['discount'] - $all_data['paid']
        ];

        $final_data = array_merge($invoice_data, $due);

        $invoice = Invoice::find($id);
        $invoice->update($final_data);

        return redirect()->route('invoices.show', $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Invoice::where('id', $id)->delete();
        return redirect()->back()->with('deleted', 'Invoice has been deleted !');
    }

}
