<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

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
        return view('products.index', compact('products'));
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
        $all_data = $request->all();
        $product_data = [
            'productname'     => $all_data['productname'],
            'stock'           => $all_data['stock'],
            'unit'            => $all_data['unit'],
            'purchaseprice'   => $all_data['purchaseprice'],
            'sellprice'       => $all_data['sellprice'],
            'currency'        => $all_data['currency'],
            'description'     => $all_data['description']
        ];

        $validate = [
            'productname'     => 'required|unique:products',
            'stock'           => 'required',
            'unit'            => 'required',
            'purchaseprice'   => 'required',
            'sellprice'       => 'required',
            'currency'        => 'required',
            'description'     => 'nullable'
        ];
        
        $request->validate($validate, $product_data);

        $product                = new Product();
        $product->productname   = $all_data['productname'];
        $product->stock         = $all_data['stock'];
        $product->unit          = $all_data['unit'];
        $product->purchaseprice = $all_data['purchaseprice'];
        $product->sellprice     = $all_data['sellprice'];
        $product->currency      = $all_data['currency'];

        if(!empty($all_data['description'])){
            $product->description = $all_data['description'];
        }
        $product->save();
        return redirect()->back()->with('product_added', 'Product has been added !');
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
        $all_data = $request->all();
        $product_data = [
            'productname'     => $all_data['productname'],
            'stock'           => $all_data['stock'],
            'unit'            => $all_data['unit'],
            'purchaseprice'   => $all_data['purchaseprice'],
            'sellprice'       => $all_data['sellprice'],
            'currency'        => $all_data['currency'],
            'description'     => $all_data['description']
        ];

        $validate = [
            'productname'     => 'required|unique:products, productname,' . $id,
            'stock'           => 'required',
            'unit'            => 'required',
            'purchaseprice'   => 'required',
            'sellprice'       => 'required',
            'currency'        => 'required',
            'description'     => 'nullable'
        ];
        
        $product = Product::find($id);
        $product->update($product_data);
        return redirect()->back()->with('product_updated', 'Product has been updated !');
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
        return redirect()->back()->with('deleted', 'Product has been deleted !');
    }
}
