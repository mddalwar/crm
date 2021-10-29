<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Exports\ProductExport;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Excel;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $products = Product::all();
        $serial = 1;
        return view('products.index', compact('products', 'serial'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products.create');
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cu = Auth::user();
        $all_data = $request->all();

        $validate_data = [
            'name'          => $all_data['name'],
            'quantity'      => $all_data['quantity'],
            'unit'          => $all_data['unit'],
            'purchaseprice' => $all_data['purchaseprice'],
            'category_id'   => $all_data['category_id'],
            'added_by'      => $cu->id,
            'note'          => $all_data['note'],
            'status'        => 'Active'
        ];

        $validate_role = [
            'name'          => 'required|unique:products',
            'quantity'      => 'required|numeric|min:1',
            'unit'          => 'required',
            'purchaseprice' => 'required|numeric|min:1',
            'category_id'   => 'required',
            'note'          => 'nullable'
        ];
        $validate_msg =[
            'productname.required'      => 'Product name is required',
            'productname.unique'        => 'Product already added',
            'quantity.required'         => 'Quantity amount is required',
            'quantity.numeric'          => 'Quantity must be an numeric value',
            'quantity.min'              => 'Quantity must be an positive value',
            'unit.required'             => 'Unit selection is required',
            'category_id.required'      => 'Category selection is required',
            'purchaseprice.required'    => 'Purchase price is required',
            'purchaseprice.numeric'     => 'Purchase price must be an numeric value',
            'purchaseprice.min'         => 'Purchase price must be an positive value',
        ];

        Validator::make($validate_data, $validate_role, $validate_msg)->validate();

        Product::create($validate_data);

        return redirect()->back()->with('success', 'Product has been added');
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
        $product = Product::find($id);
        return view('products.edit', compact('product'));
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
        $cu = Auth::user();
        $all_data = $request->all();

        $validate_data = [
            'name'          => $all_data['name'],
            'quantity'      => $all_data['quantity'],
            'unit'          => $all_data['unit'],
            'purchaseprice' => $all_data['purchaseprice'],
            'category_id'   => $all_data['category_id'],
            'updated_by'    => $cu->id,
            'note'          => $all_data['note']
        ];

        $validate_role = [
            'name'            => 'required|unique:products,name,'. $id,
            'quantity'        => 'required|numeric|min:1',
            'unit'            => 'required',
            'purchaseprice'   => 'required|numeric|min:1',
            'category_id'     => 'required',
            'note'            => 'nullable'
        ];
        $validate_msg =[
            'name.required'             => 'Product name is required',
            'name.unique'               => 'Product already added',
            'quantity.required'         => 'Quantity amount is required',
            'quantity.numeric'          => 'Quantity must be an numeric value',
            'quantity.min'              => 'Quantity must be an positive value',
            'unit.required'             => 'Unit selection is required',
            'category_id.required'      => 'Category selection is required',
            'purchaseprice.required'    => 'Purchase price is required',
            'purchaseprice.numeric'     => 'Purchase price must be an numeric value',
            'purchaseprice.min'         => 'Quantity must be an positive value',
        ];

        Validator::make($validate_data, $validate_role, $validate_msg)->validate();

        Product::where('id', $id)->update($validate_data);

        return redirect()->back()->with('success', 'Product has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Product::where('id', $id)->delete();
        return redirect()->back()->with('success', 'Product has been deleted !');
    }
    public function export() 
    {
        $products = Product::all();
        
        return Excel::download(new ProductExport, 'products.xls');
    }


    public function ajaxproducts()
    {   
        $products = DB::table('products')->select('id', 'name')->get();
        return json_encode($products);
    }

    public function addstock(){
        $products = Product::all();
        return view('products.addstock', compact('products'));
    }

    public function stockstore(Request $request){
        dd($request->all());
    }
}
