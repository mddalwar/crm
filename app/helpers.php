<?php 

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

if(!function_exists('units')){
	function units(){
		$units = [
			'Pcs',
			'Dozon',
			'Packet',
			'Box',
			'Kilogram',
			'Gram',
			'Feet',
			'Litter',
		];
		return $units;
	}
}

if(!function_exists('categories')){
	function categories(){
		$categories = DB::table('categories')->get();
		return $categories;
	}
}

if(!function_exists('user_name')){
	function user_name($id){
		$username = DB::table('users')->where('id', $id)->first();
		return $username->firstname . ' ' . $username->lastname;
	}
}

if(!function_exists('shopname')){
	function shopname(){
		$shopname = DB::table('settings')->where('setting_key', 'shopname')->first();
		return $shopname->setting_value;
	}
}

if(!function_exists('phone')){
	function phone(){
		$phone = DB::table('settings')->where('setting_key', 'phone')->first();
		return $phone->setting_value;
	}
}

if(!function_exists('logotext')){
	function logotext(){
		$logotext = DB::table('settings')->where('setting_key', 'logotext')->first();
		return $logotext->setting_value;
	}
}

if(!function_exists('email')){
	function email(){
		$email = DB::table('settings')->where('setting_key', 'email')->first();
		return $email->setting_value;
	}
}

if(!function_exists('copyright')){
	function copyright(){
		$copyright = DB::table('settings')->where('setting_key', 'copyright')->first();
		return $copyright->setting_value;
	}
}

if(!function_exists('address')){
	function address(){
		$address = DB::table('settings')->where('setting_key', 'address')->first();
		return $address->setting_value;
	}
}

if(!function_exists('products')){
	function products(){
		$products = DB::table('products')->get();
		return $products;
	}
}

if(!function_exists('monthly_invest')){
	function monthly_invest($month){
		$invest = DB::table("invests")
            ->whereRaw('MONTH(created_at) = ?',[$month])
            ->sum('invests.amount');
        return $invest;
	}
}

if(!function_exists('monthly_sell')){
	function monthly_sell($month){
		$sell = DB::table("invoices")
            ->whereRaw('MONTH(created_at) = ?',[$month])
            ->sum('invoices.totalamount');
        return $sell;
	}
}

if(!function_exists('monthly_expense')){
	function monthly_expense($month){
		$expense = DB::table("expenses")
            ->whereRaw('MONTH(created_at) = ?',[$month])
            ->sum('expenses.amount');
        return $expense;
	}
}

if(!function_exists('monthly_discount')){
	function monthly_discount($month){
		$discount = DB::table("invoices")
            ->whereRaw('MONTH(created_at) = ?',[$month])
            ->sum('invoices.discount');
        return $discount;
	}
}

if(!function_exists('monthly_due')){
	function monthly_due($month){
		$dues = DB::table("customers")
            ->whereRaw('MONTH(created_at) = ?',[$month])
            ->sum('customers.due');
        return $dues;
	}
}

if(!function_exists('monthly_profit')){
	function monthly_profit($month){
		$sell = DB::table("invoices")
            ->whereRaw('MONTH(created_at) = ?',[$month])
            ->sum('invoices.totalamount');
        $discount = DB::table("invoices")
            ->whereRaw('MONTH(created_at) = ?',[$month])
            ->sum('invoices.discount');
        $expense = DB::table("expenses")
            ->whereRaw('MONTH(created_at) = ?',[$month])
            ->sum('expenses.amount');
        $profit = $sell - $discount - $expense;

        return $profit;
	}
}

if(!function_exists('total_sell')){
	function total_sell(){
		$sell = DB::table("invoices")
            ->sum('invoices.totalamount');
        return $sell;
	}
}

if(!function_exists('total_discount')){
	function total_discount(){
		$discount = DB::table("invoices")
            ->sum('invoices.discount');
        return $discount;
	}
}

if(!function_exists('total_expense')){
	function total_expense(){
		$expense = DB::table("expenses")
            ->sum('expenses.amount');
        return $expense;
	}
}

if(!function_exists('total_dues')){
	function total_dues(){
		$dues = DB::table("customers")
            ->sum('customers.due');
        return $dues;
	}
}

if(!function_exists('total_invests')){
	function total_invests(){
		$invests = DB::table("invests")
            ->sum('invests.amount');
        return $invests;
	}
}

if(!function_exists('total_profit')){
	function total_profit(){
		$sell = DB::table("invoices")
            ->sum('invoices.totalamount');            
		$discount = DB::table("invoices")
            ->sum('invoices.discount');
        $expense = DB::table("expenses")
            ->sum('expenses.amount');
        $profit = $sell - $discount - $expense;

        return $profit;
	}
}

if(!function_exists('current_balance')){
	function current_balance(){
		$balance = total_invests() - total_profit() - total_dues();

		return $balance;
	}
}