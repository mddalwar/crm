<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = Customer::with('created_by')->get();
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
        $cu = Auth::user();

        $validate_data = [
            'name'          => $all_data['name'],
            'email'         => isset($all_data['email']) ? $all_data['email'] : null,
            'phone'         => $all_data['phone'],
            'address'       => $all_data['address'],
            'added_by'      => $cu->id,
            'status'        => 'Active'
        ];

        $validate_rule = [
            'name'          => 'required',
            'email'         => 'nullable|email:filter|unique:customers',
            'phone'         => 'required|unique:customers|min:10|regex:/(01)[0-9]/',
            'address'       => 'required'
        ];

        $validate_msg = [
            'name.required'     => 'Customer name is required',
            'email.unique'      => 'Email already exists',
            'phone.required'    => 'Phone number is required',
            'phone.reged'       => 'Phone number is invalid',
            'phone.unique'      => 'Phone number already exists',
            'address.required'  => 'Address is required'
        ];

        Validator::make($validate_data, $validate_rule, $validate_msg)->validate();

        Customer::create( $validate_data );

        return redirect()->back()->with('success', 'Customer has been added !');
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
            'name'          => $all_data['name'],
            'email'         => isset($all_data['email']) ? $all_data['email'] : null,
            'phone'         => $all_data['phone'],
            'address'       => $all_data['address'],
        ];

        $validate_data = [
            'name'          => 'required',
            'name'          => 'required',
            'email'         => 'nullable|unique:customers,email,'. $id,
            'phone'         => 'required|min:10|regex:/(1)[0-9]{9}/|unique:customers,phone, ' . $id,
            'address'       => 'required'
        ];

        $validate_rule = [
            'name'          => 'required',
            'email'         => 'nullable|email:filter|unique:customers',
            'phone'         => 'required|unique:customers|min:10|regex:/(01)[0-9]/',
            'address'       => 'required'
        ];

        $validate_msg = [
            'name.required'     => 'Customer name is required',
            'email.unique'      => 'Email already exists',
            'phone.required'    => 'Phone number is required',
            'phone.reged'       => 'Phone number is invalid',
            'phone.unique'      => 'Phone number already exists',
            'address.required'  => 'Address is required'
        ];

        Validator::make($validate_data, $validate_rule, $validate_msg)->validate();

        Customer::where('id', $id )->update($validate_data);
        
        return redirect()->back()->with('success', 'Customer has been updated !');
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
