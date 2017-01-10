<?php

namespace App\Http\Controllers;

use App\TblContactoPublicacion;
use Illuminate\Http\Request;

class MensajesController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $contactos = TblContactoPublicacion::all();
        return view('mensajes.mensaje', compact('contactos'));
    }
    
    public function show($id){
        $contacto = TblContactoPublicacion::find($id);
        if ($contacto->estado == 'leer') {
            $contacto->update([
                'estado' => 'leido'
            ]);
        }
        return view('mensajes.leer', compact('contacto'));
    }

    public function responder($id){
        $contacto = TblContactoPublicacion::find($id);
        
        return view('mensajes.responder', compact('contacto'));
    }

    public function borrar($id){
        $contacto = TblContactoPublicacion::find($id);
        $contacto->update([
            'estado' => 'inactivo'
        ]);

        return redirect('admin/mensajes');
    }
}
