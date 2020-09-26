<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invoice;
use App\Models\Product;
use App\Models\Customer;

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
            'paid'              => $all_data['paid'],
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

        $request->validate($validate_rule, $invoice_data);


        $due = [
            'due' => $all_data['totalamount'] - $all_data['discount'] - $all_data['paid']
        ];

        $final_data = array_merge($invoice_data, $due);

        Invoice::create($final_data);
        return redirect()->back()->with('invoice_created', 'Invoice has been created !');        

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
        return view('invoices.edit');
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
        //
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
