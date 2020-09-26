<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = Customer::all();
        return view('customers.index', compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('customers.create');
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
        $customer_data = [
            'firstname'     => $all_data['firstname'],
            'lastname'      => $all_data['lastname'],
            'email'         => $all_data['email'],
            'phone'         => $all_data['phone'],
            'address'       => $all_data['address']
        ];

        $validate = [
            'firstname'     => 'required',
            'lastname'      => 'required',
            'email'         => 'nullable|email:filter|unique:customers',
            'phone'         => 'required|unique:customers|min:10|regex:/(01)[0-9]{9}/',
            'address'       => 'required'
        ];
        
        $request->validate($validate, $customer_data);

        $customer = new Customer();
        $customer->firstname = $all_data['firstname'];
        $customer->lastname = $all_data['lastname'];
        if(!empty($all_data['email'])){
            $customer->email = $all_data['email'];
        }        
        $customer->phone = $all_data['phone'];
        $customer->address = $all_data['address'];
        $customer->save();
        return redirect()->back()->with('customer_created', 'Customer has been added !');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $customer = Customer::find($id);
        return view('customers.edit', compact('customer'));
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
        $customer_data = [
            'firstname'     => $all_data['firstname'],
            'lastname'      => $all_data['lastname'],
            'email'         => $all_data['email'],
            'phone'         => $all_data['phone'],
            'address'       => $all_data['address']
        ];

        $validate = [
            'firstname'     => 'required',
            'lastname'      => 'required',
            'email'         => 'nullable|unique:customers,email,'. $id,
            'phone'         => 'required|min:10|regex:/(1)[0-9]{9}/|unique:customers,phone, ' . $id,
            'address'       => 'required'
        ];

        $request->validate($validate, $customer_data);

        $customer = Customer::find($id);
        $customer->update($customer_data);
        return redirect()->back()->with('customer_updated', 'Customer has been updated !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Customer::where('id', $id)->delete();
        return redirect()->back()->with('deleted', 'Customer has been deleted !');
    }
}
