<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
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
        $current_user = Auth::user()->designation;

        if($current_user == 'Super Admin' || $current_user == 'Manager' || $current_user == 'Admin'){
            $users = DB::table('users')->get();
            return view('users.index', compact('users'));
        }else{
            abort(404);
        }   
        
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
            return view('users.create');
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
            $user = User::find($id);
            return view('users.edit', compact('user'));
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
            User::where('id', $id)->delete();
            return redirect()->back()->with('deleted', 'User has been deleted !');
        }else{
            abort(404);
        }
    }
}
