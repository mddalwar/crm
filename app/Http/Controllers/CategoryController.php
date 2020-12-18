<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        return view('categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categories.create');
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
            'categoryname'      => $data['categoryname'],
        ];

        $validate_role = [
            'categoryname'      => 'required|unique:categories',
        ];
        $validate_msg = [
            'categoryname.required'     => 'Category name is required',
            'categoryname.unique'       => 'Category already added',
        ];

        Validator::make($validate_data, $validate_role, $validate_msg)->validate();
        $store_data = [
            'categoryname'      => $validate_data['categoryname'],
            'added_by'          => $cu->id,
            'status'            => 'Active',
        ];
        Category::create($store_data);

        return redirect()->back()->with('success', 'Category has been added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = Category::find($id);
        return view('categories.index', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::find($id);
        return view('categories.edit', compact('category'));
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
            'categoryname'      => $data['categoryname'],
        ];

        $validate_role = [
            'categoryname'      => 'required|unique:categories,categoryname,'. $id,
        ];
        $validate_msg = [
            'categoryname.required'     => 'Category name is required',
            'categoryname.unique'       => 'Category already added',
        ];

        Validator::make($validate_data, $validate_role, $validate_msg)->validate();
        $store_data = [
            'categoryname'      => $validate_data['categoryname'],
            'updated_by'        => $cu->id,
            'status'            => 'Active',
        ];
        Category::where('id', $id)->update($store_data);

        return redirect()->back()->with('success', 'Category has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Category::where('id', $id)->delete();
        return redirect()->back()->with('success', 'Category has been deleted');
    }
}
