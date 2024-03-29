<?php 

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Setting;

if(!function_exists('units')){
	function units(){
		$units = [
			'Pcs',
			'Dozon',
			'Packet',
			'Box',
			'Kilogram',
			'Gram',
			'Kg',
			'Feet',
			'Litter',
		];
		return $units;
	}
}



if(!function_exists('settings')){
	function settings(){
		$settings = Cache::remember('shop_info', now()->addMinutes(), function(){
            return json_decode(Setting::where('setting_key', 'shop_info')->first()->setting_value);
        });
        return $settings;
	}
}


if(!function_exists('categories')){
	function categories(){
		$categories = DB::table('categories')->get();
		return $categories;
	}
}


if(!function_exists('total_product_in_category')){
	function total_product_in_category($id){
		$total_product = DB::table('products')->where('category_id', $id)->count();
		return $total_product;
	}
}

if(!function_exists('user_name')){
	function user_name($id){
		$username = DB::table('users')->where('id', $id)->first();
		return $username->firstname . ' ' . $username->lastname;
	}
}

if(!function_exists('products')){
	function products(){
		$products = DB::table('products')->get();
		return $products;
	}
}

if(!function_exists('product_name')){
	function product_name($id){
		$product = DB::table('products')->where('id', $id)->first();
		return $product->name;
	}
}

if(!function_exists('product_unit')){
	function product_unit($id){
		$product = DB::table('products')->where('id', $id)->first();
		return $product->unit;
	}
}

if(!function_exists('customers')){
	function customers(){
		$customers = DB::table('customers')->get();
		return $customers;
	}
}

if(!function_exists('customer_name')){
	function customer_name($id){
		$customer = DB::table('customers')->where('id', $id)->first();
		return $customer->name;
	}
}

if(!function_exists('customer_email')){
	function customer_email($id){
		$customer = DB::table('customers')->where('id', $id)->first();

		if(!empty($customer->email)){
			return $customer->email;
		}else{
			return '';
		}
	}
}

if(!function_exists('customer_phone')){
	function customer_phone($id){
		$customer = DB::table('customers')->where('id', $id)->first();

		if(!empty($customer->phone)){
			return $customer->phone;
		}else{
			return '';
		}
	}
}
if(!function_exists('customer_address')){
	function customer_address($id){
		$customer = DB::table('customers')->where('id', $id)->first();

		if(!empty($customer->address)){
			return $customer->address;
		}else{
			return '';
		}
	}
}

if(!function_exists('customer_due')){
	function customer_due($id){
		$customer = DB::table('customers')->where('id', $id)->first();

		if(!empty($customer->due)){
			return $customer->due;
		}else{
			return 0;
		}
	}
}

if(!function_exists('invoice_product_count')){
	function invoice_product_count($id){
		$products = DB::table('invoice_products')->where('invoice', $id)->count();
		return $products;
	}
}

if(!function_exists('invoice_products')){
	function invoice_products($id){
		$products = DB::table('invoice_products')->where('invoice', $id)->get();
		return $products;
	}
}

if(!function_exists('monthly_invest')){
	function monthly_invest($month = NULL, $year = NULL){
		if($month == NULL){
			$month = date('m');
		}

		if($year == NULL){
			$year = date('Y');
		}

		$invest = DB::table("invests")
            ->whereMonth('created_at', $month)
            ->whereYear('created_at', $year)
            ->sum('invests.amount');
        return $invest;
	}
}

if(!function_exists('monthly_sell')){
	function monthly_sell($month = NULL, $year = NULL){
		if($month == NULL){
			$month = date('m');
		}

		if($year == NULL){
			$year = date('Y');
		}
		$sell = DB::table("invoices")
            ->whereMonth('created_at', $month)
            ->whereYear('created_at', $year)
            ->sum('invoices.total');
        return $sell;
	}
}

if(!function_exists('monthly_expense')){
	function monthly_expense($month = NULL, $year = NULL){

		if($month == NULL){
			$month = date('m');
		}

		if($year == NULL){
			$year = date('Y');
		}

		$expense = DB::table("expenses")
            ->whereMonth('created_at', $month)
            ->whereYear('created_at', $year)
            ->sum('expenses.amount');
        return $expense;
	}
}

if(!function_exists('monthly_discount')){
	function monthly_discount($month = NULL, $year = NULL){
		if($month == NULL){
			$month = date('m');
		}

		if($year == NULL){
			$year = date('Y');
		}

		$discount = DB::table("invoices")
            ->whereMonth('created_at', $month)
            ->whereYear('created_at', $year)
            ->sum('invoices.discount');
        return $discount;
	}
}

if(!function_exists('monthly_due')){
	function monthly_due($month = NULL, $year = NULL){
		if($month == NULL){
			$month = date('m');
		}

		if($year == NULL){
			$year = date('Y');
		}

		$dues = DB::table("customers")
            ->whereMonth('created_at', $month)
            ->whereYear('created_at', $year)
            ->sum('customers.due');
        return $dues;
	}
}

if(!function_exists('monthly_collection')){
	function monthly_collection($month = NULL, $year = NULL){

		if($month == NULL){
			$month = date('m');
		}

		if($year == NULL){
			$year = date('Y');
		}

		$collections = DB::table("collections")
            ->whereMonth('created_at', $month)
            ->whereYear('created_at', $year)
            ->sum('collections.amount');
        return $collections;
	}
}

if(!function_exists('monthly_profit')){
	function monthly_profit($month = NULL, $year = NULL){

		if($month == NULL){
			$month = date('m');
		}

		if($year == NULL){
			$year = date('Y');
		}

		$profit = DB::table("invproducts")
            ->whereMonth('created_at', $month)
            ->whereYear('created_at', $year)
            ->sum('invproducts.profit');
        return $profit;
	}
}

if(!function_exists('total_sell')){
	function total_sell(){
		$sell = DB::table("invoices")
            ->sum('invoices.total');
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

if(!function_exists('total_collection')){
	function total_collection(){
		$collection = DB::table("collections")
            ->sum('collections.amount');
        return $collection;
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
		$profit = DB::table("invproducts")
            ->sum('invproducts.profit');
        return $profit;
	}
}
