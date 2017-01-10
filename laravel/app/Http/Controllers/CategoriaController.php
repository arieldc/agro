<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoriaRequest;
use App\Http\Requests\CrearAtributosRequest;
use App\Tbl_Categoria;
use App\Tbl_publicaciones;
use App\TblAtributosGlobales;
use App\TblAtributosGlobalesValores;
use App\TblCategoriaAtributos;
use App\TblPublicacionCategoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoriaController extends Controller
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
        //$categoriaItems = Tbl_Categoria::tree();
        $categoria = Tbl_Categoria::orderBy('created_at', 'DECS')->get();
        return view('categoria.index', compact('categoria'));
        //return $categoriaItems;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $categoria = Tbl_Categoria::orderBy('nombre', 'ASC')->get();
        return view('categoria.create', compact('categoria'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoriaRequest $request)
    {
        //
        $input = $request->all();
        Tbl_Categoria::create($input);
        return redirect('admin/categoria');
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
        $categoria = Tbl_Categoria::find($id);
        return $categoria;
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
        $todasCategoria = Tbl_Categoria::orderBy('nombre', 'ASC')->get();
        $categoria = Tbl_Categoria::find($id);
        $id_padre = $categoria->id_padre;
        $nombrePadre = "";
        if ($id_padre != 0){
            $categPadre = Tbl_Categoria::find($id_padre);
            if ($categPadre != null) {
                $nombrePadre = $categPadre->nombre;
            }
        }

        return view('categoria.edit', compact('categoria', 'todasCategoria', 'nombrePadre', 'activarTab'));
        //return $categoria;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoriaRequest $request, $id)
    {
        //
        $categoria = Tbl_Categoria::find($id);
        $categoria->update($request->all());
        return redirect('admin/categoria');

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
        /*$borrar = false;
        $publicacionesCategorias = TblPublicacionCategoria::all();
        foreach ($publicacionesCategorias as $categoria){
            if ($categoria->id_categoria == $id){
                $borrar = true;
            }else{
                $borrar = false;
            }
        }

        if ($borrar){
            return redirect('admin/categoria');
        }else{
            $categoriaAtributos = TblCategoriaAtributos::all();
            foreach ($categoriaAtributos as $atributo){
                if ($atributo->id_categoria == $id){
                    $deleteAtrCate = TblCategoriaAtributos::find($atributo->id);
                    $deleteAtrCate->delete();
                }
            }

            $categoria = Tbl_Categoria::find($id);
            $categoria->delete();
            return redirect('admin/categoria');
        }*/
        /***** Borrando Publicaciones Categorias *****/
        $publicCategoria = TblPublicacionCategoria::all();
        foreach ($publicCategoria as $publicCategorias){
            if ($publicCategorias->id_categoria == $id){
                $deletePublicCateg = TblPublicacionCategoria::find($publicCategorias->id);
                $deletePublicCateg->delete();
            }
        }
        /***** Borrando Categoria Atributos *****/
        $categoriaAtributos = TblCategoriaAtributos::all();
        foreach ($categoriaAtributos as $atributo){
            if ($atributo->id_categoria == $id){
                $deleteCategAtrib = TblCategoriaAtributos::find($atributo->id);
                $deleteCategAtrib->delete();
            }
        }
        /***** update id_padre = 0 *****/
        $allCategorias = Tbl_Categoria::all();
        foreach ($allCategorias as $categorias){
            if ($categorias->id_padre != 0){
                if ($categorias->id_padre == $id){
                    $updateCategoria = Tbl_Categoria::find($categorias->id);
                    $updateCategoria->update([
                        'id_padre' => 0
                    ]);
                }
            }
        }

        /***** Borrando Categoria *****/
        $categoria = Tbl_Categoria::find($id);
        $categoria->delete();

        return redirect('admin/categoria');
    }

    public function getAtributos($id){
        //
        $todasCategoria = Tbl_Categoria::orderBy('nombre', 'ASC')->get();
        $allcategoriaId = Tbl_Categoria::find($id);
        $todosAtributos = TblAtributosGlobales::orderBy('nombre', 'ASC')->get();

        /*foreach ($allcategoriaId->categoriaAtributos as $atributo){
            $atributoID = TblAtributosGlobales::find($atributo->id);
            $allcategoriaId = array_add($allcategoriaId, 'categoria_atributos_'.$atributo->id, $atributoID);
            
        }*/

        return view('categoria.atributos', compact('todasCategoria', 'todosAtributos', 'id', 'allcategoriaId'));
    }

    public function storeAtributos(CrearAtributosRequest $request, $id)
    {
        $input = $request->all();
        TblAtributosGlobales::create($input);

        $atributosGlob = TblAtributosGlobales::all('id');
        $idUltimiAtrGlob = $atributosGlob->last();

        $vistaAtr = $request->get('vista');
        foreach ($vistaAtr as $vista) {
            TblAtributosGlobalesValores::create([
                'id_atributos_globales' => $idUltimiAtrGlob->id,
                'value_vista' => $vista['value'],
                'estado' => $vista['estado']
            ]);
        }

        TblCategoriaAtributos::create([
            'id_categoria' => $id,
            'id_atributo' => $idUltimiAtrGlob->id,
            'estado' => $request->get('estado')
        ]);

        return redirect('admin/categoria/'.$id.'/atributos');
        //dd($request->all());
    }
    
    public function addAtributos(Request $request, $id){
        TblCategoriaAtributos::create([
            'id_categoria' => $id,
            'id_atributo' => $request->atributos,
            'estado' => $request->estado
        ]);
        return redirect('admin/categoria/'.$id.'/atributos');
    }

    public function editAtributos($id, $idatr){
        $atributos = TblAtributosGlobales::find($idatr);
        $urlActualizar = "admin/categoria/$id/atributos/$idatr";
        $urlCancel = "admin/categoria/$id/atributos";
        return view('atributos.edit', compact('atributos', 'urlActualizar', 'urlCancel'));
    }
    
    public function updateAtributos(CrearAtributosRequest $request, $id, $idatr){

        $atributos = TblAtributosGlobales::find($idatr);
        $atributos->update($request->all());

        $atrGlobValor = TblAtributosGlobalesValores::all('id', 'id_atributos_globales');
        foreach ($atrGlobValor as $atrGlob)
        {
            if ($atrGlob->id_atributos_globales == $idatr)
            {
                $aGlobValor = TblAtributosGlobalesValores::find($atrGlob->id);
                $aGlobValor->delete();
            }
        }

        $vistaAtr = $request->get('vista');

        foreach ($vistaAtr as $vista) {
            TblAtributosGlobalesValores::create([
                'id_atributos_globales' => $idatr,
                'value_vista' => $vista['value'],
                'estado' => $vista['estado']
            ]);
        }
        return redirect('admin/categoria/'.$id.'/atributos');
        //return $request->all();
    }

    public function deleteAtributos($id, $idatr){
        //$categoria = Tbl_Categoria::find($id);
        //$categoria->delete();

        $categoriaAtributos = TblCategoriaAtributos::all();
        foreach ($categoriaAtributos as $atributo){
            if ($atributo->id_atributo == $idatr){
                $deleteAtrCate = TblCategoriaAtributos::find($atributo->id);
                $deleteAtrCate->delete();
            }
        }
        return redirect('admin/categoria/'.$id.'/atributos');
    }
}
