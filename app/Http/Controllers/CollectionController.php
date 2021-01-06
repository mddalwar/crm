<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class CollectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $collections = Collection::all();
        return view('collections.index', compact('collections'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('collections.create');
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
        $cu = Auth::user();

        $validate_data = [
            'customer'      => $data['customer'],
            'amount'        => $data['amount'],
            'note'          => $data['note'],
        ];

        $validate_role = [
            'customer'      => 'required',
            'amount'        => 'required|numeric|min:0',
            'note'          => 'nullable',
        ];
        $validate_msg = [
            'customer.required'     => 'You have to select a customer',
            'amount.required'       => 'Amount is required field',
            'amount.numeric'        => 'Amount should be numeric value',
            'amount.min'            => 'Amount should be positive value',
        ];
        Validator::make($validate_data, $validate_role, $validate_msg)->validate();

        $customer = Customer::find($data['customer']);

        if(empty($customer->due)){
            return redirect()->back()->with('faild', 'Customer have not any due');
        }

        if($customer->due < $validate_data['amount'] ){
            return redirect()->back()->with('faild', 'Customer due amount exceed');
        }

        if(!empty($customer->due)){
            $update_due = $customer->due - $validate_data['amount'];
            Customer::where('id', $customer->id)->update(['due' => $update_due]);
        }else{
            return redirect()->back()->with('faild', 'Customer have not any due');
        }

        $validate_data['prevdue']       = $customer->due;
        $validate_data['collect_by']    = $cu->id;

        Collection::create($validate_data);
        return redirect()->back()->with('success', 'Collection has been created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $collection = Collection::find($id);
        return view('collections.collection', compact('collection'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }
}
