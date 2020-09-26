<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
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
        $user_data = [
            'firstname'     => $all_data['firstname'],
            'lastname'      => $all_data['lastname'],
            'email'         => $all_data['email'],
            'designation'   => $all_data['designation'],
            'password'      => bcrypt($all_data['password'])
        ];

        $validate = [
            'firstname'     => 'required',
            'lastname'      => 'required',
            'email'         => 'required|email|unique:users',
            'designation'   => 'required',
            'password'      => 'required|confirmed|min:6'
        ];
        $request->validate($validate, $user_data);

        User::create($user_data);
        return redirect()->back()->with('user_created', 'User has been created !');
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
        $user = User::find($id);
        return view('users.edit', compact('user'));
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
        $user_data = [
            'firstname'     => $all_data['firstname'],
            'lastname'      => $all_data['lastname'],
            'email'         => $all_data['email'],
            'designation'   => $all_data['designation']
        ];

        $validate = [
            'firstname'     => 'required',
            'lastname'      => 'required',
            'email'         => 'required|unique:users,email,'. $id,
            'designation'   => 'required'
        ];
        $request->validate($validate, $user_data);

        $user = User::find($id);
        $user->update($user_data);
        return redirect()->back()->with('user_updated', 'User has been updated !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::where('id', $id)->delete();
        return redirect()->back()->with('deleted', 'User has been deleted !');
    }
}
