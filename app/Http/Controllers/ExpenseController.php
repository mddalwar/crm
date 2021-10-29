<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Expense;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $expenses = Expense::all();

        return view('expenses.index', compact('expenses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('expenses.create');
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

        $validate_data = [
            'title'             => $all_data['title'],
            'amount'            => $all_data['amount'],
            'consumer'          => $all_data['consumer'],
            'reference'         => $all_data['reference'],
            'note'              => $all_data['note'],
        ];

        $validate_rule = [
            'title'             => 'required',
            'amount'            => 'required|min:1|numeric',
            'consumer'          => 'required',
            'reference'         => 'nullable|string',
            'note'              => 'nullable|string',
        ];

        $validate_msg = [
            'title.required'    => 'Title is required',
            'amount.required'   => 'Amount is required',
            'consumer.required' => 'Consumer name is required',
            'reference.string'  => 'Reference should be text',
            'note.string'       => 'Note should be text',
        ];

        Validator::make($validate_data, $validate_rule, $validate_msg)->validate();

        Expense::create($validate_data);

        return redirect()->back()->with('success', 'Expense has been added !');
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
        $expense = Expense::find($id);

        return view('expenses.edit', compact('expense'));
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

        $validate_data = [
            'title'             => $all_data['title'],
            'amount'            => $all_data['amount'],
            'consumer'          => $all_data['consumer'],
            'reference'         => $all_data['reference'],
            'note'              => $all_data['note'],
        ];

        $validate_rule = [
            'title'             => 'required',
            'amount'            => 'required|min:1|numeric',
            'consumer'          => 'required',
            'reference'         => 'nullable|string',
            'note'              => 'nullable|string',
        ];

        $validate_msg = [
            'title.required'    => 'Title is required',
            'amount.required'   => 'Amount is required',
            'consumer.required' => 'Consumer name is required',
            'reference.string'  => 'Reference should be text',
            'note.string'       => 'Note should be text',
        ];

        Validator::make($validate_data, $validate_rule, $validate_msg)->validate();

        Expense::where('id', $id)->update($validate_data);

        return redirect()->back()->with('success', 'Expense has been updated !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Expense::where('id', $id)->delete();
        return redirect()->back()->with('success', 'Expense has been deleted !');
    }
}
