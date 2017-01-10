<?php

namespace App\Http\Controllers;

use App\Http\Requests\CrearAtributosRequest;
use App\TblAtributosGlobales;
use App\TblAtributosGlobalesValores;
use App\TblCategoriaAtributos;
use App\TblPublicacionAtributosGlobales;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AtributosController extends Controller
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
        //$atributos = TblAtributosGlobales::all();
        $atributos = TblAtributosGlobales::orderBy('created_at', 'DESC')->get();
        return view('atributos.index', compact('atributos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $atributos = TblAtributosGlobales::all();
        return view('atributos.create', compact('atributos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CrearAtributosRequest $request)
    {
        $input = $request->all();
        TblAtributosGlobales::create($input);

        $atributosGlob = TblAtributosGlobales::all('id');
        $idUltimiAtrGlob = $atributosGlob->last();

        $elemento = $request->get('elemento');

        $vistaAtr = $request->get('vista');

        /*if ($elemento == "selectbox" || $elemento == "multiselectbox" || $elemento == "radio" || $elemento == "checkboxgroup")
        {*/
            foreach ($vistaAtr as $vista)
            {
                TblAtributosGlobalesValores::create([
                    'id_atributos_globales' => $idUltimiAtrGlob->id,
                    'value_vista' => $vista['value'],
                    'estado' => $vista['estado']
                ]);
            }
        //}

        return redirect('admin/atributo');
        //return TblAtributosGlobalesValores::all();
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
        $atributos = TblAtributosGlobales::find($id);
        $urlActualizar = "admin/atributo/$id";
        $urlCancel = "admin/atributo";
        return view('atributos.edit', compact('atributos', 'urlActualizar', 'urlCancel'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CrearAtributosRequest $request, $id)
    {
        //
        $atributos = TblAtributosGlobales::find($id);
        $atributos->update($request->all());

        $atrGlobValor = TblAtributosGlobalesValores::all('id', 'id_atributos_globales');
        foreach ($atrGlobValor as $atrGlob)
        {
            if ($atrGlob->id_atributos_globales == $id)
            {
                $aGlobValor = TblAtributosGlobalesValores::find($atrGlob->id);
                $aGlobValor->delete();
            }
        }

        $elemento = $request->get('elemento');

        $vistaAtr = $request->get('vista');

        if ($elemento == "selectbox" || $elemento == "multiselectbox" || $elemento == "radio" || $elemento == "checkboxgroup")
        {
            foreach ($vistaAtr as $vista)
            {
                TblAtributosGlobalesValores::create([
                    'id_atributos_globales' => $id,
                    'value_vista' => $vista['value'],
                    'estado' => $vista['estado']
                ]);
            }
        }
        return redirect('admin/atributo');
        //return $request->all();
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
        $borrar = false;
        /*$categoriaAtributos = TblCategoriaAtributos::all();
        foreach ($categoriaAtributos as $atributos){
            if ($atributos->id_atributo == $id){
                $borrar = true;
            }else{
                $borrar = false;
            }
        }

        if ($borrar){
            $mensaje = "Este Atributo no puede ser Eliminado. Hace parte de una Categoria";
            return redirect('admin/atributo');
        }else{
            $atrGlobValor = TblAtributosGlobalesValores::all('id', 'id_atributos_globales');
            foreach ($atrGlobValor as $atrGlob) {
                if ($atrGlob->id_atributos_globales == $id) {
                    $aGlobValor = TblAtributosGlobalesValores::find($atrGlob->id);
                    $aGlobValor->delete();
                }
            }

            $atributos = TblAtributosGlobales::find($id);
            $atributos->delete();
            return redirect('admin/atributo');
        }*/

        /***** Borrando publicaciones atributos *****/
        $publicacionAtr = TblPublicacionAtributosGlobales::all();
        foreach ($publicacionAtr as $publicAtr){
            if ($publicAtr->id_atributo == $id){
                $deletePublicAtr = TblPublicacionAtributosGlobales::find($publicAtr->id);
                $deletePublicAtr->delete();
            }
        }
        /*****  Borrando Atributos Globales Valores *****/
        $atrGlobValor = TblAtributosGlobalesValores::all();
        foreach ($atrGlobValor as $atrValores){
            if ($atrValores->id_atributos_globales == $id){
                $deleteAtrValores = TblAtributosGlobalesValores::find($atrValores->id);
                $deleteAtrValores->delete();
            }
        }
        /***** Borrando Categoria Atributos *****/
        $categoriaAtr = TblCategoriaAtributos::all();
        foreach ($categoriaAtr as $categAtr){
            if ($categAtr->id_atributo == $id){
                $deleteCateAtr = TblCategoriaAtributos::find($categAtr->id);
                $deleteCateAtr->delete();
            }
        }
        /***** Borrando Atributos Globales *****/
        $atributosGlobales = TblAtributosGlobales::find($id);
        $atributosGlobales->delete();
        return redirect('admin/atributo');
    }
}
