<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

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
        $shopname_query = DB::table('settings')->where('setting_key', 'shopname')->get();
        $shopname = $shopname_query[0]->setting_value;

        $phone_query = DB::table('settings')->where('setting_key', 'phone')->get();
        $phone = $phone_query[0]->setting_value;

        $logotext_query = DB::table('settings')->where('setting_key', 'logotext')->get();
        $logotext = $logotext_query[0]->setting_value;

        $email_query = DB::table('settings')->where('setting_key', 'email')->get();
        $email = $email_query[0]->setting_value;

        $copyright_query = DB::table('settings')->where('setting_key', 'copyright')->get();
        $copyright = $copyright_query[0]->setting_value;

        $address_query = DB::table('settings')->where('setting_key', 'address')->get();
        $address = $address_query[0]->setting_value;

        return view('settings', compact('shopname', 'phone', 'logotext', 'email', 'copyright', 'address'));
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

        return redirect()->back()->with('settings_changed', 'Settings has been updated !');
    }

    public function dues(){
        $dues = DB::table('customers')->where('due', '>', 0)->get();

        return view('dues', compact('dues'));
    }

    public function addstock(){
        $products = Product::all();
        return view('addstock', compact('products'));
    }

    public function stockstore(Request $request){
        dd($request->all());
    }
    
}
