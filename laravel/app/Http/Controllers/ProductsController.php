<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\db_products;
use App\db_imagenes;

class ProductsController extends Controller
{
	public function features(){
		$resultado = [];
		$features = db_products::orderBy('updated_at', 'DESC')->take(8)->get();

		foreach ($features as $fea) {
			$img = db_imagenes::where('id_publicacion',$fea->id)->get();
			$resultado[] = array(
				'publicacion' => $fea, 
				'images' => $img
				);
		}
		
		return response()->json($resultado);
	}

}
