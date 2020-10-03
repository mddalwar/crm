<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $currency_query = DB::table('settings')->where('setting_key', 'currency')->get();
        $currency = $currency_query[0]->setting_value;

        $products = Product::all();
        return view('products.index', compact('products', 'currency'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $current_user = Auth::user()->designation;

        if($current_user == 'Super Admin' || $current_user == 'Admin'){
            return view('products.create');
        }else{
            abort(404);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $current_user = Auth::user()->designation;

        if($current_user == 'Super Admin' || $current_user == 'Admin'){
            $all_data = $request->all();
            $product_data = [
                'productname'     => $all_data['productname'],
                'stock'           => $all_data['stock'],
                'unit'            => $all_data['unit'],
                'purchaseprice'   => $all_data['purchaseprice'],
                'sellprice'       => $all_data['sellprice'],
                'description'     => $all_data['description']
            ];

            $validate = [
                'productname'     => 'required|unique:products',
                'stock'           => 'required',
                'unit'            => 'required',
                'purchaseprice'   => 'required',
                'sellprice'       => 'required',
                'description'     => 'nullable'
            ];
            
            $request->validate($validate, $product_data);

            $product                = new Product();
            $product->productname   = $all_data['productname'];
            $product->stock         = $all_data['stock'];
            $product->unit          = $all_data['unit'];
            $product->purchaseprice = $all_data['purchaseprice'];
            $product->sellprice     = $all_data['sellprice'];

            if(!empty($all_data['description'])){
                $product->description = $all_data['description'];
            }
            $product->save();
            return redirect()->back()->with('product_added', 'Product has been added !');
        }else{
            abort(404);
        }
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
        $current_user = Auth::user()->designation;
        
        if($current_user == 'Super Admin' || $current_user == 'Admin'){
            $product = Product::find($id);
            return view('products.edit', compact('product'));
        }else{
            abort(404);
        }
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
        $current_user = Auth::user()->designation;
        
        if($current_user == 'Super Admin' || $current_user == 'Admin'){
            $all_data = $request->all();
            $product_data = [
                'productname'     => $all_data['productname'],
                'stock'           => $all_data['stock'],
                'unit'            => $all_data['unit'],
                'purchaseprice'   => $all_data['purchaseprice'],
                'sellprice'       => $all_data['sellprice'],
                'description'     => $all_data['description']
            ];

            $validate = [
                'productname'     => 'required|unique:products, productname,' . $id,
                'stock'           => 'required',
                'unit'            => 'required',
                'purchaseprice'   => 'required',
                'sellprice'       => 'required',
                'description'     => 'nullable'
            ];
            
            $product = Product::find($id);
            $product->update($product_data);
            return redirect()->back()->with('product_updated', 'Product has been updated !');
        }else{
            abort(404);
        }
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
            Product::where('id', $id)->delete();
            return redirect()->back()->with('deleted', 'Product has been deleted !');
        }else{
            abort(404);
        }
    }
}
