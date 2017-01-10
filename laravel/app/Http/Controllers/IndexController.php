<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class IndexController extends Controller
{
    
    public function feature_products(){
    	$cats= DB::table('categorias')->get();
    	$cats_child= DB::table('categorias_hija')->get();
    	$products = DB::table('products')->get();
    	return view('welcome', ['products' => $products,'cats'=>$cats,'cats_child'=>$cats_child,'single'=>0]);
    }

    public function show(){

    }
}
