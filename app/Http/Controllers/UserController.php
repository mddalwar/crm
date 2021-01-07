<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

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

        $validate_data = [
            'firstname'     => $all_data['firstname'],
            'lastname'      => $all_data['lastname'],
            'email'         => $all_data['email'],
            'designation'   => 'Super Admin', //$all_data['designation'],
            'password'      => $all_data['password'],
            'password_confirmation' => $all_data['password_confirmation'],
        ];

        $validate_role = [
            'firstname'     => 'required',
            'lastname'      => 'required',
            'email'         => 'required|email|unique:users',
            'designation'   => 'required',
            'password'      => 'required|confirmed|min:6',
            'password_confirmation'      => 'required',
        ];

        $validate_msg = [
            'firstname.required'        => 'First Name is required',
            'lastname.required'         => 'Last Name is required',
            'email.required'            => 'Email is required',
            'email.unique'              => 'User already exists',
            'designation.required'      => 'Designation is required',
            'password.required'         => 'Password is required',
            'password.confirmed'        => 'Both password are not matched',
        ];

        Validator::make($validate_data, $validate_role, $validate_msg)->validate();

        $validate_data['password'] = Hash::make($all_data['password']);

        User::create($validate_data);
        return redirect()->back()->with('success', 'User has been created !');
        
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
            'designation'   => 'Super Admin', //$all_data['designation']
        ];

        $validate = [
            'firstname'     => 'required',
            'lastname'      => 'required',
            'email'         => 'required|unique:users,email,'. $id,
        ];
        $request->validate($validate, $user_data);

        $user = User::find($id);
        $user->update($user_data);
        return redirect()->back()->with('success', 'User has been updated !');
        
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
