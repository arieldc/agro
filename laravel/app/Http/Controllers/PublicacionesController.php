<?php

namespace App\Http\Controllers;

use App\Http\Requests\PublicacionesRequest;
use App\Tbl_Categoria;
use App\Tbl_publicaciones;
use App\TblAtributosGlobales;
use App\TblContactoPublicacion;
use App\TblPublicacionAtributosGlobales;
use App\TblPublicacionCategoria;
use App\TblPublicacionImagenes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PublicacionesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        //$publicaciones = Tbl_publicaciones::all();
        $publicaciones = Tbl_publicaciones::orderBy('created_at', 'DESC')->get();
        return view('publicaciones.index', compact('publicaciones'));

        //return Tbl_publicaciones::find(49)->publicacionCategoria;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $publicaciones = Tbl_publicaciones::all();
        $categorias = Tbl_Categoria::all();
        return view('publicaciones.create', compact('publicaciones', 'categorias'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PublicacionesRequest $request)
    {
        //
        $input = $request->all(); //datos q vienen del formulario
        Tbl_publicaciones::create($input); //guardar datos en tabla publicaciones

        $publicaciones = Tbl_publicaciones::all('id'); //buscar el
        $idUltimoPublico = $publicaciones->last();   // ultimo id de publicaciones

        $inputCate = $request->get('id_categoria');
        foreach ($inputCate as $cate){
            TblPublicacionCategoria::create([
               'id_categoria' => $cate,
                'id_producto' => $idUltimoPublico->id,
                'estado' => 'activa'
            ]);
        }
        //return redirect('publicaciones');

        $patch = public_path().'/uploads/'.$idUltimoPublico->id.'/'; //Directorio para subir imagenes
        
        $files = $request->file('ruta');

        foreach ($files as $file) {
            $fileName = $file->getClientOriginalName();
            TblPublicacionImagenes::create([
                'id_publicacion' => $idUltimoPublico->id,
                'ruta' => 'uploads/' . $idUltimoPublico->id . '/' . $fileName,
                'estado' => 'activo'
            ]);
            $file->move($patch, $fileName);
        }

        //return TblPublicacionImagenes::all();
        return redirect('admin/publicaciones/'.$idUltimoPublico->id.'/atributos');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $publicaciones = Tbl_publicaciones::find($id);
        return $publicaciones;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $publicaciones = Tbl_publicaciones::find($id);
        $categorias = Tbl_Categoria::all();

        return view('publicaciones.edit', compact('publicaciones', 'categorias'));
        //return $publicaciones;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PublicacionesRequest $request, $id)
    {
        //
        $publicaciones = Tbl_publicaciones::find($id);
        $publicaciones->update($request->all());

        $publicacionesCate = TblPublicacionCategoria::all(['id','id_producto']);
        foreach ($publicacionesCate as $publiCateg){
            if ($publiCateg->id_producto == $id){
                $pCategoria = TblPublicacionCategoria::find($publiCateg->id);
                $pCategoria->delete();
            }
        }
        $inputCate = $request->get('id_categoria');
        foreach ($inputCate as $cate){
            TblPublicacionCategoria::create([
                'id_categoria' => $cate,
                'id_producto' => $id,
                'estado' => 'activa'
            ]);
        }
        return redirect('admin/publicaciones');
        //dd($request);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        /***** Borrando Publicaciones Categorias *****/
        $publicacionesCate = TblPublicacionCategoria::all(['id','id_producto']);
        foreach ($publicacionesCate as $publiCateg){
            if ($publiCateg->id_producto == $id){
                $pCategoria = TblPublicacionCategoria::find($publiCateg->id);
                $pCategoria->delete();
            }
        }
        /***** Borrando Publicaciones img *****/
        $publicacionesImg = TblPublicacionImagenes::all();
        foreach ($publicacionesImg as $publiImg){
            if ($publiImg->id_publicacion == $id){
                $pImagen = TblPublicacionImagenes::find($publiImg->id);
                $pImagen->delete();
            }
        }
        /***** Borrando Publicaciones atributos globales *****/
        $publicacionAtr = TblPublicacionAtributosGlobales::all();
        foreach ($publicacionAtr as $publicAtr){
            if ($publicAtr->id_publicacion == $id){
                $deletePublicAtr = TblPublicacionAtributosGlobales::find($publicAtr->id);
                $deletePublicAtr->delete();
            }
        }

        /***** Borrando Contacto Publicacion *****/
        $contacPublicacion = TblContactoPublicacion::all();
        foreach ($contacPublicacion as $contact){
            if ($contact->id_publicacion == $id){
                $deleteContactos = TblContactoPublicacion::find($contact->id);
                $deleteContactos->delete();
            }
        }

        $patch = '/uploads/'.$id.'/';
        Storage::deleteDirectory($patch);

        $publicaciones = Tbl_publicaciones::find($id);
        $publicaciones->delete();
        return redirect('admin/publicaciones');
    }
    
    public function imagen($id){

        $publicaciones = Tbl_publicaciones::find($id);
        $imagenes = $publicaciones->publicacionImagen;
        return view('publicaciones.imagen', compact('imagenes', 'publicaciones'));
    }

    public function guardarImg(Request $request, $id)
    {
        $patch = public_path().'/uploads/'.$id.'/'; //Directorio para subir imagenes

        $files = $request->file('ruta');

        foreach ($files as $file) {
            $fileName = $file->getClientOriginalName();
            //echo $fileName.'/'.$id;
            TblPublicacionImagenes::create([
                'id_publicacion' => $id,
                'ruta' => 'uploads/' . $id . '/' . $fileName,
                'estado' => 'activo'
            ]);
            $file->move($patch, $fileName);
        }
        return $request->id_publicacion;
    }
    
    public function deleteImg(Request $request ,$id){

        $publicacionesImg = TblPublicacionImagenes::find($request->key);
        $publicacionesImg->delete();

        $patch = '/'.$request->ruta;
        Storage::delete($patch);
        return $id;
    }

    public function atributos($id){
        $publicaciones = Tbl_publicaciones::find($id);
        $publicaciones->publicacionCategoria;
        $publicaciones->publicacionAtributos;

        $atribGlobales = [];
        foreach ($publicaciones->publicacionCategoria as $categorias){
            $categoriasAtr = Tbl_Categoria::find($categorias->id);
            $categoria_atributos = $categoriasAtr->categoriaAtributos;
            //echo $categoria_atributos;
            foreach ($categoria_atributos as $atributos){
                //echo $atributos;
                $atribGlobales[$atributos->id] = TblAtributosGlobales::find($atributos->id);
                $atribGlobales[$atributos->id]->atrGlobalValores;
            }
        }

        //return $atribGlobales;

        //return $publicaciones;

        return view('publicaciones.atributos' ,compact('publicaciones', 'atribGlobales'));
    }
    
    public function atributosMostrar($id, $idcate){
        $categorias = Tbl_Categoria::find($idcate);

        $option = '<option value=""></option>';
        foreach ($categorias->categoriaAtributos as $atributo){
            $option .= "<option value='$atributo->id'>$atributo->nombre</option>";
        }
        //return $categorias->id;
        return $option;
    }

    public function valoresMostrar($id, $idvalor){
        $atribGlobales = TblAtributosGlobales::find($idvalor);
        $atribGlobales->atrGlobalValores;
        $csrf = csrf_field();
        $data = "<form action='atributos/addAtr' class='form-horizontal' method='post' enctype='multipart/form-data'>
                    <div class='box-body'>
                        <div class='form-group'>
                            <label for='nombre' class='col-sm-2 control-label'>Nombre</label>

                            <div class='col-sm-10'>
                                $csrf
                                <input type='hidden' name='id' value='$atribGlobales->id'>
                                <input type='text' name='nombre' id='nombre' class='form-control' value='$atribGlobales->nombre' disabled>
                            </div>
                        </div>
                    </div>
                    
                    <div class='box-body'>
                        <div class='form-group'>
                            <label for='elemento' class='col-sm-2 control-label'>Elemento</label>

                            <div class='col-sm-10'>
                                <input type='text' name='elemento' id='elemento' class='form-control' value='$atribGlobales->elemento' disabled>
                            </div>
                        </div>
                    </div>
                    <div class='box-body'>
                        <div class='form-group'>
                            <label for='value_vista' class='col-sm-2 control-label'>Seleccioné Valor</label>

                            <div class='col-sm-10'>";

        switch ($atribGlobales->elemento){
            case 'input':
                $data .= "<input type='text' name='value_vista' class='form-control' required>";
                break;
            case 'textarea':
                $data .= "<textarea name='value_vista' class='form-control' required></textarea>";
                break;
            case 'selectbox';
                $data .= "<select name='value_vista' class='form-control' required>";
                $data .= "<option></option>";
                foreach ($atribGlobales->atrGlobalValores as $valores){
                    $data .= "<option value='$valores->value_vista'>$valores->value_vista</option>";
                }
                $data .= "</select>";
                break;
            case 'multiselectbox':
                $data .= "<select name='value_vista[]' required multiple='multiple' style='width: 100%' class='form-control select2'>";
                foreach ($atribGlobales->atrGlobalValores as $valores){
                    $data .= "<option value='$valores->value_vista'>$valores->value_vista</option>";
                }
                $data .= "</select>";
                break;
            case 'radio':
                foreach ($atribGlobales->atrGlobalValores as $valores){
                    $data .= "<label class='form-control'><input type='radio' required name='value_vista' value='$valores->value_vista'> $valores->value_vista</label>";
                }
                break;
            case 'checkbox':
                $data .= '<div class="checkbox-group required">';
                foreach ($atribGlobales->atrGlobalValores as $valores){
                    $data .= "<label class='form-control'><input type='checkbox' required name='value_vista[]' value='$valores->value_vista'> $valores->value_vista</label>";
                }
                $data .= '</div>';
                break;
            case 'checkboxgroup':
                $data .= '<div class="checkbox-group required">';
                foreach ($atribGlobales->atrGlobalValores as $valores){
                    $data .= "<label class='form-control'><input type='checkbox' required name='value_vista[]' value='$valores->value_vista'> $valores->value_vista</label>";
                }
                $data .= '</div>';
                break;
            case 'file':
                $data .= "<input type='file' required name='value_vista' class='form-control'>";
                break;
            case 'hidden':
                break;
        }



        $data .=            "</div>
                        </div>
                    </div>
                    <div class='box-footer'>
                    <a href='' class='btn btn-default'>Cancel</a>
                    <button type='submit' class='btn btn-primary pull-right'>Guardar</button>
                </div>
                </form>";

        return $data;
    }

    public function agregarAtributos(Request $request, $id){
        $array = is_array($request->get('value_vista'));

        if ($array){
            foreach ($request->get('value_vista') as $value){
                TblPublicacionAtributosGlobales::create([
                    'id_publicacion' => $id,
                    'id_atributo' => $request->get('id'),
                    'valor_atributo' => $value
                ]);
            }
        }else{

                TblPublicacionAtributosGlobales::create([
                    'id_publicacion' => $id,
                    'id_atributo' => $request->get('id'),
                    'valor_atributo' => $request->get('value_vista')
                ]);
        }

        $atrPubliGlobal = TblPublicacionAtributosGlobales::all();
        $publicaciones = Tbl_publicaciones::find($id);
        $publicaciones->publicacionAtributos;
        return redirect('admin/publicaciones/'.$id.'/atributos');
    }

    public function agregarAtributos2(Request $request, $id){

        TblPublicacionAtributosGlobales::where('id_publicacion', $id)->delete();


        $input = $request->all();
        foreach ($input as $key => $value){
            if ($key != '_token'){
                //echo $key;
                if ($key != $value) {
                    foreach ($value as $value2){
                        if ($value2 != "") {
                            //echo $value2;
                            TblPublicacionAtributosGlobales::create([
                                'id_publicacion' => $id,
                                'id_atributo' => $key,
                                'valor_atributo' => $value2
                            ]);
                        }
                    }
                }
            }
        }
        //return $request->all();
        //return redirect('admin/publicaciones/'.$id.'/atributos');
        return redirect('admin/publicaciones');
    }

    public function borrarAtributos($id, $idAtr){
        $atriPublic = TblPublicacionAtributosGlobales::find($idAtr);
        $atriPublic->delete();
        //return $idAtr;
        return redirect('admin/publicaciones/'.$id.'/atributos');
    }
}
