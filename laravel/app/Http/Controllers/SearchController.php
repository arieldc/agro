<?php

namespace App\Http\Controllers;

use App\Tbl_Categoria;
use App\Tbl_publicaciones;
use App\TblAtributosGlobales;
use Illuminate\Http\Request;
use DB;


class SearchController extends Controller
{
	public function buscar_form(Request $request){
		$src=$request->input('src');
		return redirect('buscar/'.$src);    	
	}
     public function buscar($src){
        $cats= DB::table('tbl_categoria')->get();
        $cats_child= DB::table('tbl_categoria')->where('id_padre','!=',0)->get();	
     	$products= DB::table('tbl_publicaciones')->where('titulo','LIKE','%'.$src.'%')->get();

    	return view('layouts.itemhome', ['products' => $products,'cats'=>$cats,'cats_child'=>$cats_child,'single'=>0]);       	
     }

	public function buscarApi($buscar){
		$number_por_page = 6;
		$publicaciones = Tbl_publicaciones::where('titulo', 'LIKE', "%$buscar%")->orderBy('created_at','DESC')->paginate($number_por_page);
		//$publicaciones = Tbl_publicaciones::where('titulo', 'LIKE', "%$buscar%")->orderBy('created_at','DESC')->paginate(2);
		$categorias = Tbl_Categoria::where('nombre', 'LIKE', "%$buscar%")->orderBy('created_at','DESC')->get();
		//$atributos = TblAtributosGlobales::where('nombre', 'LIKE', "%$buscar%")->get();

		$imagen = [];
		$attr = [];
		$attri = [];
		$attri_tmp = [];
		$attri_final = [];
		$atributos = [];

		foreach ($publicaciones as $publicacione) {
			$id = $publicacione->id;
			//$publicacione->publicacionImagenId($id);
			$publicImag = Tbl_publicaciones::find($id);
			$attr[$id] = $publicImag->publicacionAtributos;
			$imagen[$id] = $publicImag->publicacionImagen;
			//$imagen = $publicImag->publicacionImagen;
		}

		foreach ($attr as $key => $value) {
			$attri_tmp[]=array(
				'id_p'=>$key,
				'attr'=>$value
				);
			foreach ($value as $values){
				//echo $values;
				$atributos[$values->id] = TblAtributosGlobales::find($values->id);
				$atributos[$values->id]->publicaciones;
			}

		}
		
		$buscar = [
			"publicaciones" => $publicaciones,
			'imagen' => $imagen,
			//'atributos' => $attri_tmp,
			'atributos' => $atributos,
			'categorias' => $categorias
		];
		//return $attri_tmp;
		//return $atributos;
		return $buscar;
	}
}
