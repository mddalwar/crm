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