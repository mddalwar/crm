<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function dashboard()
    {
        return view('dashboard');
    }

    public function settings()
    {
        $settings = Setting::all();
        return view('settings', compact('settings'));
    }

    public function setting_change(Request $request)
    {
        $all_data = $request->all();

        $setting_data = [
            'shopname'      => $all_data['shopname'],
            'phone'         => $all_data['phone'],
            'email'         => $all_data['email'],
            'logotext'      => $all_data['logotext'],
            'copyright'     => $all_data['copyright'],
            'address'       => $all_data['address']
        ];

        $validate = [
            'shopname'      => 'required',
            'phone'         => 'required|integer|min:9',
            'email'         => 'nullable|email',
            'logotext'      => 'required',
            'copyright'     => 'required',
            'address'       => 'required'
        ];

        $request->validate($validate, $setting_data);

        $settings = Setting::find($all_data['settingid']);
        $settings->update($setting_data);
        return redirect()->back()->with('settings_changed', 'Settings has been updated !');
    }

}
