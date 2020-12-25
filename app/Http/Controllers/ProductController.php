<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Mail;

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
            'productname'     => $all_data['productname'],
            'stock'           => $all_data['stock'],
            'unit'            => $all_data['unit'],
            'purchaseprice'   => $all_data['purchaseprice'],
            'category'        => $all_data['category'],
            'added_by'        => $cu->id,
            'description'     => $all_data['description']
        ];

        $validate_role = [
            'productname'     => 'required|unique:products',
            'stock'           => 'required|numeric',
            'unit'            => 'required',
            'purchaseprice'   => 'required|numeric',
            'category'        => 'required',
            'description'     => 'nullable'
        ];
        $validate_msg =[
            'productname.required'      => 'Product name is required',
            'productname.unique'        => 'Product already added',
            'stock.required'            => 'Primary stock amount is required',
            'stock.numeric'             => 'Primary stock must be an numeric value',
            'unit.required'             => 'Unit selection is required',
            'category.required'         => 'Category selection is required',
            'purchaseprice.required'    => 'Purchase price is required',
            'purchaseprice.numeric'     => 'Purchase price must be an numeric value',
        ];

        Validator::make($validate_data, $validate_role, $validate_msg)->validate();

        Product::create($validate_data);

        return redirect()->back()->with('success', 'Product has been added successfully');
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
            'productname'     => $all_data['productname'],
            'stock'           => $all_data['stock'],
            'unit'            => $all_data['unit'],
            'purchaseprice'   => $all_data['purchaseprice'],
            'category'        => $all_data['category'],
            'updated_by'      => $cu->id,
            'description'     => $all_data['description']
        ];

        $validate_role = [
            'productname'     => 'required|unique:products,productname,'. $id,
            'stock'           => 'required|numeric',
            'unit'            => 'required',
            'purchaseprice'   => 'required|numeric',
            'category'        => 'required',
            'description'     => 'nullable'
        ];
        $validate_msg =[
            'productname.required'      => 'Product name is required',
            'productname.unique'        => 'Product already added',
            'stock.required'            => 'Primary stock amount is required',
            'stock.numeric'             => 'Primary stock must be an numeric value',
            'unit.required'             => 'Unit selection is required',
            'category.required'         => 'Category selection is required',
            'purchaseprice.required'    => 'Purchase price is required',
            'purchaseprice.numeric'     => 'Purchase price must be an numeric value',
        ];

        Validator::make($validate_data, $validate_role, $validate_msg)->validate();

        Product::where('id', $id)->update($validate_data);

        return redirect()->back()->with('success', 'Product has been updated successfully');
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

    public function ajaxproducts()
    {   
        $products = DB::table('products')->select('id', 'productname')->get();
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
