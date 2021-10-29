<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Cache;
use App\Models\Setting;

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
        
        $settings = [
            'shopname'  => $setting_data['shopname'],
            'phone'     => $setting_data['phone'],
            'email'     => $setting_data['email'],
            'logotext'  => $setting_data['logotext'],
            'copyright' => $setting_data['copyright'],
            'address'   => $setting_data['address']
        ];

        Setting::where('setting_key', 'shop_info')->update([
            'setting_value' => json_encode($settings)
        ]);

        Cache::forget('shop_info');

        return redirect()->back()->with('success', 'Settings has been updated !');
    }

    public function dues(){
        $dues = DB::table('customers')->where('due', '>', 0)->get();

        return view('dues', compact('dues'));
    }

}
