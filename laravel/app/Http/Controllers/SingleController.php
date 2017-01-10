<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class SingleController extends Controller
{
    public function singlewithuser($author,$product,$id_product){
        $cats= DB::table('tbl_categoria')->get();
        $cats_child= DB::table('tbl_categoria')->where('id_padre','!=',0)->get();
     	$products= DB::table('tbl_publicaciones')->where('id',$id_product)->first();
    	return view('layouts.itemhome', ['products' => $products,'cats'=>$cats,'cats_child'=>$cats_child,'single'=>1]);         	
    }

    public function single($product,$id_product){
        $cats= DB::table('tbl_categoria')->get();
        $cats_child= DB::table('tbl_categoria')->where('id_padre','!=',0)->get();
        $products= DB::table('tbl_publicaciones')->where('id',$id_product)->first();
    	return view('layouts.itemhome', ['products' => $products,'cats'=>$cats,'cats_child'=>$cats_child,'single'=>1]);         	
    }    
}
