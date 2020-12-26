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
        $invests = Invest::all();
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
            'investby'      => $data['investby'],
            'amount'        => $data['amount'],
            'note'          => isset($data['note']) ? $data['note'] : NULL,
            'added_by'      => $cu->id,
        ];

        $validate_rule = [
            'investby'      => 'required',
            'amount'        => 'required|numeric',
            'note'          => 'nullable',
            'added_by'      => 'required',
        ];
        $error_message = [
            'investby.required'      => 'Who is invested this amount !',
            'amount.required'        => 'Investment amount is required !',
            'amount.numeric'         => 'Investment amount should be numeric value !',
        ];
        Validator::make($validate_data, $validate_rule, $error_message)->validate();

        Invest::create($validate_data);

        return redirect()->back()->with('success', 'Invest added with the total Investment !');
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

        $validate_data = [
            'investby'      => $data['investby'],
            'amount'        => $data['amount']
        ];

        $validate_rule = [
            'investby'      => 'required',
            'amount'        => 'required'
        ];
        $error_message = [
            'investby.required'      => 'Who is invested this amount !',
            'amount.required'        => 'Investment amount is required !'
        ];
        Validator::make($validate_data, $validate_rule, $error_message)->validate();

        $note = [
            'note'      => $data['note']
        ];

        $final_data = array_merge($validate_data, $note);

        $invest = Invest::find($id);
        $invest->update($final_data);

        return redirect()->back()->with('invest_edited', 'Invest modified with the total investment !');
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
