<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invoice;
use App\Models\Product;
use App\Models\Customer;
use App\Models\Invproduct;
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
        $data = $request->all();

        // Customer Selection or addition
        if(isset($data['newCustomer'])){
            // New Customer Addition
            $newCustomer = [
                'customername'      => $data['customername'],
                'email'             => isset($data['email']) ? $data['email'] : NULL,
                'phone'             => $data['phone'],
                'address'           => $data['address'],
            ];
            $customerRule = [
                'customername'      => 'required',
                'email'             => 'nullable|unique:customers|email',
                'phone'             => 'required|unique:customers|numeric',
                'address'           => 'required',
            ];
            $customerMsg  = [
                'customername.required' => 'Customer name is required',
                'email.unique'          => 'Customer email already exists',
                'phone.required'        => 'Customer phone is required',
                'phone.unique'          => 'Customer email already exists',
                'address'               => 'Customer address is required',
            ];

            Validator::make($newCustomer, $customerRule, $customerMsg)->validate();
            $customer = Customer::create($newCustomer)->id;

        }else{
            // Existing Customer
            $customer = isset($data['customer']) ? $data['customer'] : NULL;
        }

        $due = $data['grandTotal'] - $data['paid'];

        $invoiceData = [
            'customer'      => $customer,
            'discount'      => isset($data['discount']) ? $data['discount'] : NULL,
            'paid'          => isset($data['paid']) ? $data['paid'] : NULL,
            'due'           => isset($due) ? $due : NULL,
            'subtotal'      => $data['subtotal'],
            'total'         => $data['grandTotal'],
            'note'          => $data['note'],
        ];
        $invoiceRule = [
            'customer'      => 'required',
            'subtotal'      => 'required'
        ];
        $invoiceMsg   = [
            'customer.required' => 'You have choose a customer or create new',
        ];

        Validator::make($invoiceData, $invoiceRule, $invoiceMsg)->validate();
        $invoice = Invoice::create($invoiceData);

        $products = $request->product;
        $quantity = $request->quantity;
        $price = $request->price;
        $total = $request->total;

        for ($product = 0; $product < count($products); $product++) {
            if ($products[$product] != '') {
                $invProduct = [
                    'invoice'       => $invoice->id,
                    'product'       => $products[$product],
                    'quantity'      => $quantity[$product],
                    'price'         => $price[$product],
                    'total'         => $total[$product],
                    'status'        => 'Active',
                ];

                Invproduct::create($invProduct);
            }
        }

        return redirect()->back()->with('success', 'Invoice has been created');

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
        if(isset($invoice)){
            $product = Product::find($invoice->productid);
            $customer = Customer::find($invoice->customerid);
            return view('invoices.invoice', compact('invoice', 'product', 'customer'));
        }else{
            abort(404);
        }
        
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
            'sellquantity.required'      => 'Sell quantity is required !',
            'totalamount.required'       => 'Sell quantity is required !',
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
