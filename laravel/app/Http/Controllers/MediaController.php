<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\db_imagenes;

class MediaController extends Controller
{
	public function image($id){
		$img = db_imagenes::where('id',$id)->get();
	}
}
