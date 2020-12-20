<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class SettingController extends Controller
{
    
    public function settings()
    {      
        return view('settings');
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
        $message = [
            'shopname.required'      => 'Shop name is required',
            'phone.required'         => 'Phone number is required',
            'logotext.required'      => 'Logo text is required',
            'copyright.required'     => 'Copyright text is required',
            'address.required'       => 'Address is required'
        ];
        Validator::make($setting_data, $validate, $message)->validate();
        
        $shopname_update = DB::table('settings')->where('setting_key', 'shopname')->update(['setting_value' => $all_data['shopname']]);
        $phone_update = DB::table('settings')->where('setting_key', 'phone')->update(['setting_value' => $all_data['phone']]);
        $logotext_update = DB::table('settings')->where('setting_key', 'logotext')->update(['setting_value' => $all_data['logotext']]);
        $email_update = DB::table('settings')->where('setting_key', 'email')->update(['setting_value' => $all_data['email']]);
        $copyright_update = DB::table('settings')->where('setting_key', 'copyright')->update(['setting_value' => $all_data['copyright']]);
        $address_update = DB::table('settings')->where('setting_key', 'address')->update(['setting_value' => $all_data['address']]);

        return redirect()->back()->with('success', 'Settings has been updated !');
    }

    public function dues(){
        $dues = DB::table('customers')->where('due', '>', 0)->get();

        return view('dues', compact('dues'));
    }

}
