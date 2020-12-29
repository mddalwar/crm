<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\Product;
use App\Models\Stock;

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stocks = Stock::all();
        return view('stocks.index', compact('stocks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('stocks.create');
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
            'product'       => isset($data['product']) ? $data['product'] : NULL,
            'stock'         => isset($data['stock']) ? $data['stock'] : NULL,
            'price'         => isset($data['price']) ? $data['price'] : NULL,
            'note'          => isset($data['note']) ? $data['note'] : NULL,
        ];
        $validate_rule = [
            'product'       => 'required',
            'stock'         => 'required|numeric|min:0',
            'price'         => 'required|numeric|min:0',
            'note'          => 'nullable',
        ];
        $validate_msg = [
            'product.required'    => 'You have to select a product',
            'stock.required'      => 'Stock amount is required',
            'stock.numeric'       => 'Stock amount should be numeric value',
            'stock.min'           => 'Negetive value is not allowed for the stock',
            'price.required'      => 'Price amount is required',
            'price.numeric'       => 'Price amount should be numeric value',
            'price.min'           => 'Negetive value is not allowed for the price',
        ];

        Validator::make($validate_data, $validate_rule, $validate_msg)->validate();

        $product = Product::find($validate_data['product']);

        $prevtotal      = $product->stock * $product->purchaseprice;
        $presenttotal   = $validate_data['stock'] * $validate_data['price'];
        $totalstock     = $product->stock + $validate_data['stock'];

        $total          = $prevtotal + $presenttotal;
        $avarageprice   = $total / $totalstock;

        $final_data = [
            'product'       => $validate_data['product'],
            'stock'         => $validate_data['stock'],
            'prevstock'     => $product->stock,
            'price'         => $validate_data['price'],
            'avarageprice'  => $avarageprice,
            'note'          => isset($validate_data['note']),
            'added_by'      => $cu->id,
        ];

        Product::where('id', $validate_data['product'])->update(['purchaseprice' => $avarageprice, 'stock' => $totalstock]);
        Stock::create($final_data);

        return redirect()->back()->with('success', 'Stock successfully added');


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
        $stock = Stock::find($id);
        return view('stocks.edit', compact('stock'));
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
        Stock::where('id', $id)->delete();
        return redirect()->back()->with('success', 'Stock has been deleted');
    }
}
