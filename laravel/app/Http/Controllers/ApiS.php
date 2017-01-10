<?php

namespace App\Http\Controllers;

use App\Tbl_Categoria;
use App\Tbl_newsleter;
use App\Tbl_publicaciones;
use App\TblAtributosGlobales;
use App\TblPublicacionAtributosGlobales;
use App\TblPublicacionCategoria;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Input;
use DB;

class ApiS extends Controller
{
    public function categoriasAll(){
        $categorias = array();
        $categorias_all=Tbl_Categoria::all();
 
            foreach ($categorias_all as $cat) {
                if($cat->id_padre == 0){

                $categorias[] = array(
                        'parent'=>$cat->id,
                        'name'=>$cat->nombre,
                        'subscat'=>Tbl_Categoria::where('id_padre',$cat->id)->get(),
                        );
            }
        }
            
        return response()->json($categorias);
    }

    public function categoriasId($id){
        $categorias = Tbl_Categoria::find($id);
        $atrCate = $categorias->categoriaAtributos;

        foreach ($atrCate as $atributos){
            $atr = TblAtributosGlobales::find($atributos->id);
            $atr->atrGlobalValores;

            //array_push($categorias, 'atr', $atr);
        }

        dd($categorias);
    }

    public function publicacionesAll(){
        $publicacion = Tbl_publicaciones::paginate(12);
        return $publicacion;
    }

    public function publicacionesId($id){

        $publicaciones = Tbl_publicaciones::find($id);
        $publicaciones->publicacionImagen;
        $publicaciones->publicacionCategoria;
        $publicaciones->publicacionAtributos;
        return $publicaciones;
    }

    public function recomendados($id){
        $recomendados = TblPublicacionCategoria::where('id_categoria',$id)->orderBy('created_at','DESC')->take(4)->get();
        return response()->json($recomendados);
    }

    public function productscat($slug){
        $main_cat = array();
        //$publicaciones = TblPublicacionCategoria::where('id_categoria',$id)->get();
        $id = Tbl_Categoria::where('nombre',$slug)->first();
        $id = $id->id;
        $publicaciones = TblPublicacionCategoria::where('id_categoria',$id)->paginate(6);
        $allCategorias = Tbl_Categoria::where('id',$id)->get();
        if($allCategorias[0]->id_padre!=0){
            $main_cat[] = Tbl_Categoria::where('id',$allCategorias[0]->id_padre)->first();
            $main_cat[] = $allCategorias[0];            

        }else{
            $main_cat[] = $allCategorias[0];
        }

        $imagen = [];
        $attr = [];
        $publi_single = [];
        $categoria = [];

        $publicImag = [];
        $atributos = [];

        foreach ($publicaciones as $publicacione) {
            $id = $publicacione->id_producto;
            $pubfill[] = Tbl_publicaciones::find($id);
            //$publi_single[] = Tbl_publicaciones::find($id);
            //$publi_single[] = Tbl_publicaciones::where('id',$id)->orderBy('created_at','DESC')->first();
            $publi_single[] = Tbl_publicaciones::where('id',$id)->orderBy('created_at','DESC')->first();
            $publicImag[$id] = Tbl_publicaciones::find($id);
            $attr[$id] = $publicImag[$id]->publicacionAtributos;
            $imagen[$id] = $publicImag[$id]->publicacionImagen;
            $categoria[$id] = $publicImag[$id]->publicacionCategoria;

            /*$publicImag[$id]->publicacionAtributos;
            $publicImag[$id]->publicacionImagen;
            $publicImag[$id]->publicacionCategoria;*/
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

        $array = array_reverse(array_sort($publi_single, function ($value) {
            return $value['created_at'];
        }));

        $paginator = new Paginator($array, 2, 10);
        //$paginator = Paginator::make($array, count($array), 2);
        $page = Input::get('page', 1);
        $perPage = 2;
        $offset = ($page * $perPage) - $perPage;

        $publicaciones = array(
            'last_page'=>$publicaciones->lastPage()
            );
        $publicaciones['data'] = $pubfill;

        $buscar = [
            //"publicaciones" => $publi_single,
            "publicaciones" => $publicaciones,
            //"publicaciones" => $paginator,
            'imagen' => $imagen,
            //'publicacion_atributos' => $attr,
            'atributos' => $atributos,
            //'publicacion_categoria' => $categoria
            'publicacion_categoria' => $main_cat
        ];
        return $buscar;

        //return $publicImag;

    }
    
    public function newsleter(Request $request){
        $input = $request->all();
        Tbl_newsleter::create($input);
    }

    public function atriPublic($id, $valor){
        $atr = TblPublicacionAtributosGlobales::where([
            ['id_atributo', '=', $id],
            ['valor_atributo', '=', $valor]
        ])->get();
        $atr_pagination =         $atr = TblPublicacionAtributosGlobales::where([
            ['id_atributo', '=', $id],
            ['valor_atributo', '=', $valor]
        ])->paginate(6);

        $publicAtributos = [];
        $imagen = [];
        $attr = [];
        $atributos = [];
        $pubfill = [];

        foreach ($atr as $atrPublic){
            $idAtr = $atrPublic->id;
            $publicAtributosValores = TblPublicacionAtributosGlobales::find($idAtr);
            $publicAtributos[] = $publicAtributosValores->atributosPublicaciones;

        }
        foreach ($publicAtributos as $publicacione) {
            $id = $publicacione->id;
            $pubfill[] = Tbl_publicaciones::find($id);
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
                //echo $values->id;
                $atributos[$values->id] = TblAtributosGlobales::find($values->id);
                $atributos[$values->id]->publicaciones;
            }

        }

        //$atr->atributosPublicaciones;
        $publicAtributos = array();
        $publicAtributos['data'] = $pubfill;
        $buscar = [
            "publicaciones" => $publicAtributos,
            'imagen' => $imagen,
            //'atributos' => $attri_tmp,
            'atributos' => $atributos,
            //'categorias' => $categorias
        ];

        return $buscar;
    }

    public function attr2($slug){
        $publicaciones = array();
        $id = DB::table('tbl_categoria')->where('nombre',$slug)->first();
        if($id->id_padre!=0){
            $publicaciones['publicacion_categoria'][] = DB::table('tbl_categoria')->where('id',$id->id_padre)->first();
            $publicaciones['publicacion_categoria'][] = $id;
        }else{
            $publicaciones['publicacion_categoria'][] = $id;
        }
        
        $cat_attr = DB::table('tbl_publicacion_categoria')->where('id_categoria',$id->id)->get();
        foreach ($cat_attr as $key) {
            $publi_attr = DB::table('tbl_publicaciones')->where('id',$key->id_producto)->get();
            foreach ($publi_attr as $pattr) {
                $publicaciones['publicaciones'][$key->id_producto]=$pattr;
                $attr_ = DB::table('tbl_publicacion_atributos_globales')->where('id_publicacion',$key->id_producto)->get();
                $publicaciones['valores_'][$key->id_producto] = $attr_;             
                
                foreach ($attr_ as $at_) {
                    $valor_ = DB::table('tbl_atributos_globales')->where('id',$at_->id_atributo)->first();
                    $publicaciones['atributos'][$at_->id_atributo] = $valor_;    
                }
          
           }

           $publicaciones['imagen'][$key->id_producto]=DB::table('tbl_publicacion_imagenes')->where('id_publicacion',$key->id_producto)->get();
        }

        foreach ($publicaciones['valores_'] as $key) {
            foreach ($key as $value) {
                $publicaciones['valores'][$value->id_atributo][]=array(
                    'id_publicacion' => $value->id_publicacion,
                    'valor' => $value->valor_atributo,
                    'id_atributo' => $value->id_atributo,
                    'cat' => $slug
                    );
            }
        }
        $publicaciones['publicaciones'] = DB::table('tbl_publicacion_categoria')->where('id_categoria',$id->id)->paginate(6);
        $publicaciones['pagination'] = DB::table('tbl_publicacion_categoria')->where('id_categoria',$id->id)->paginate(6);
        return response()->json($publicaciones);
    }

    public function atriPublic2($id_attr,$valor,$slug){
        $publicaciones = array();
        $id = DB::table('tbl_categoria')->where('nombre',$slug)->first();
        $cat_attr = DB::table('tbl_publicacion_categoria')->where('id_categoria',$id->id)->get();
        foreach ($cat_attr as $key) {
            $publi_attr = DB::table('tbl_publicaciones')->where('id',$key->id_producto)->get();//aqui descartar los
            foreach ($publi_attr as $pattr) {
                $exist_ = DB::table('tbl_publicacion_atributos_globales')
                ->where('id_atributo',$id_attr)
                ->where('valor_atributo',$valor)
                ->exists();
                if($exist_){
                $publi_ = DB::table('tbl_publicacion_atributos_globales')
                ->where('id_atributo',$id_attr)
                ->where('valor_atributo',$valor)
                ->get();
                foreach ($publi_ as $ke_) {
                    $publicaciones['publicaciones'][$ke_->id_publicacion]=DB::table('tbl_publicaciones')->where('id',$ke_->id_publicacion)->first();
                }
                
                
            }
                $attr_ = DB::table('tbl_publicacion_atributos_globales')->where('id_publicacion',$key->id_producto)->get();
                $publicaciones['valores_'][$key->id_producto] = $attr_;             
                
                foreach ($attr_ as $at_) {
                    $valor_ = DB::table('tbl_atributos_globales')->where('id',$at_->id_atributo)->first();
                    $publicaciones['atributos'][$at_->id_atributo] = $valor_;    
                }
            }
           

           $publicaciones['imagen'][$key->id_producto]=DB::table('tbl_publicacion_imagenes')->where('id_publicacion',$key->id_producto)->get();
        }

        foreach ($publicaciones['valores_'] as $key) {
            foreach ($key as $value) {
                $publicaciones['valores'][$value->id_atributo][]=array(
                    'id_publicacion' => $value->id_publicacion,
                    'valor' => $value->valor_atributo,
                    'id_atributo' => $value->id_atributo,
                    'cat' => $slug
                    );
            }
        }
        $publicaciones['publicaciones']['data']=$publicaciones['publicaciones'];
        return response()->json($publicaciones);
    } 

    public function search2($src){
        $publicaciones = array();
        $id = DB::table('tbl_categoria')->where('nombre',$src)->first();
        $cat_attr = DB::table('tbl_publicaciones')->where('titulo','LIKE','%'.$src.'%')->get();
        foreach ($cat_attr as $key) {
            $publi_attr = DB::table('tbl_publicaciones')->where('id',$key->id)->get();
            foreach ($publi_attr as $pattr) {
                $publicaciones['publicaciones'][$key->id]=$pattr;
                $attr_ = DB::table('tbl_publicacion_atributos_globales')->where('id_publicacion',$key->id)->get();
                $publicaciones['valores_'][$key->id] = $attr_;             
                
                foreach ($attr_ as $at_) {
                    $valor_ = DB::table('tbl_atributos_globales')->where('id',$at_->id_atributo)->first();
                    $publicaciones['atributos'][$at_->id_atributo] = $valor_;    
                }
          
           }

           $publicaciones['imagen'][$key->id]=DB::table('tbl_publicacion_imagenes')->where('id_publicacion',$key->id)->get();
        }

        foreach ($publicaciones['valores_'] as $key) {
            foreach ($key as $value) {
                $publicaciones['valores'][$value->id_atributo][]=array(
                    'id_publicacion' => $value->id_publicacion,
                    'valor' => $value->valor_atributo,
                    'id_atributo' => $value->id_atributo,
                    'cat' => $src
                    );
            }
        }
        $publicaciones['publicaciones'] =DB::table('tbl_publicaciones')->where('titulo','LIKE','%'.$src.'%')->paginate(6);
        $publicaciones['pagination'] = DB::table('tbl_publicaciones')->where('titulo','LIKE','%'.$src.'%')->paginate(6);
        return response()->json($publicaciones);
    }

    public function atriPublic2src($id_attr,$valor,$src){
        $publicaciones = array();
        $cat_attr = DB::table('tbl_publicaciones')->where('titulo','LIKE','%'.$src.'%')->get();
        foreach ($cat_attr as $key) {
            $publi_attr = DB::table('tbl_publicaciones')->where('id',$key->id)->get();//aqui descartar los
            foreach ($publi_attr as $pattr) {
                $exist_ = DB::table('tbl_publicacion_atributos_globales')
                ->where('id_atributo',$id_attr)
                ->where('valor_atributo',$valor)
                ->exists();
                if($exist_){
                $publi_ = DB::table('tbl_publicacion_atributos_globales')
                ->where('id_atributo',$id_attr)
                ->where('valor_atributo',$valor)
                ->get();
                foreach ($publi_ as $ke_) {
                    $publicaciones['publicaciones'][$ke_->id_publicacion]=DB::table('tbl_publicaciones')->where('id',$ke_->id_publicacion)->first();
                }
                
                
            }
                $attr_ = DB::table('tbl_publicacion_atributos_globales')->where('id_publicacion',$key->id)->get();
                $publicaciones['valores_'][$key->id] = $attr_;             
                
                foreach ($attr_ as $at_) {
                    $valor_ = DB::table('tbl_atributos_globales')->where('id',$at_->id_atributo)->first();
                    $publicaciones['atributos'][$at_->id_atributo] = $valor_;    
                }
            }
           

           $publicaciones['imagen'][$key->id]=DB::table('tbl_publicacion_imagenes')->where('id_publicacion',$key->id)->get();
        }

        foreach ($publicaciones['valores_'] as $key) {
            foreach ($key as $value) {
                $publicaciones['valores'][$value->id_atributo][]=array(
                    'id_publicacion' => $value->id_publicacion,
                    'valor' => $value->valor_atributo,
                    'id_atributo' => $value->id_atributo,
                    'cat' => $src
                    );
            }
        }
        $publicaciones['publicaciones']['data']=$publicaciones['publicaciones'];
        return response()->json($publicaciones);
    } 
    
}
