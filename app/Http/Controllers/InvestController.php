<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Invest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class InvestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $invests = Invest::with('created_by')->get();
        return view('invests.index', compact('invests'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('invests.create');
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
            'investor_name' => $data['investor_name'],
            'amount'        => $data['amount'],
            'note'          => isset($data['note']) ? $data['note'] : NULL,
            'added_by'      => $cu->id,
        ];

        $validate_rule = [
            'investor_name' => 'required',
            'amount'        => 'required|numeric|min:1',
            'note'          => 'nullable',
        ];
        $error_message = [
            'investor_name.required' => 'Investor name is required !',
            'amount.required'        => 'Investment amount is required !',
            'amount.numeric'         => 'Investment amount should be numeric value !',
            'amount.min'             => 'Investment amount should be more than zero !',
        ];
        Validator::make($validate_data, $validate_rule, $error_message)->validate();

        Invest::create($validate_data);

        return redirect()->back()->with('success', 'Investment added successfully !');
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
        $invest = Invest::find($id);
        return view('invests.edit', compact('invest'));
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
        $data = $request->all();
        $cu = Auth::user();

        $validate_data = [
            'investor_name' => $data['investor_name'],
            'amount'        => $data['amount'],
            'note'          => isset($data['note']) ? $data['note'] : null, 
            'updated_by'    => $cu->id
        ];

        $validate_rule = [
            'investor_name' => 'required',
            'amount'        => 'required|numeric|min:1',
            'note'          => 'nullable|string'
        ];
        $validate_msg = [
            'investor_name.required' => 'Investor name is required !',
            'amount.required'        => 'Investment amount is required !'
        ];

        Validator::make($validate_data, $validate_rule, $validate_msg)->validate();

        Invest::where('id', $id)->update($validate_data);

        return redirect()->back()->with('success', 'Investment updated successfully !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $current_user = Auth::user()->designation;
        
        if($current_user == 'Super Admin'){
            Invest::where('id', $id)->delete();
            return redirect()->back()->with('deleted', 'Invest reduced from total investment !');
        }else{
            abort(404);
        }
    }
}
