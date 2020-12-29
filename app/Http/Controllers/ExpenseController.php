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

        $data = [
            'expensetitle'      => $all_data['expensetitle'],
            'amount'            => $all_data['amount'],
            'expenseby'         => $all_data['expenseby'],
            'reference'         => $all_data['reference'],
            'note'              => $all_data['note'],
        ];

        $validation = [
            'expensetitle'      => 'required',
            'amount'            => 'required|min:1|numeric',
            'expenseby'         => 'required',
            'reference'         => 'nullable',
            'note'              => 'nullable',
        ];

        $request->validate($validation, $data);

        Expense::create($data);

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

        $data = [
            'expensetitle'      => $all_data['expensetitle'],
            'amount'            => $all_data['amount'],
            'expenseby'         => $all_data['expenseby'],
            'reference'         => $all_data['reference'],
            'note'              => $all_data['note'],
        ];

        $validation = [
            'expensetitle'      => 'required',
            'amount'            => 'required|min:1|numeric',
            'expenseby'         => 'required',
            'reference'         => 'nullable',
            'note'              => 'nullable',
        ];

        $request->validate($validation, $data);

        Expense::where('id', $id)->update($data);

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
