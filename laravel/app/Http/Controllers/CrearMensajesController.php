<?php

namespace App\Http\Controllers;

use App\TblContactoPublicacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Tbl_publicaciones;

class CrearMensajesController extends Controller
{
    //
    
    public function create(){
        $form = '
             <form action="mensajes" method="post">
                    '.csrf_field().'
                <input type="text" name="id_publicacion" id="" placeholder="id_publicacion">
                <input type="text" name="nombre" id="" placeholder="nombre">
                <input type="text" name="apellido" id="" placeholder="apellido">
                <input type="email" name="email" id="" placeholder="email">
                <input type="tel" name="telefono" id="" placeholder="telefono">
                <textarea name="descripcion" id="" cols="30" rows="10"></textarea>
                <input type="text" name="estado" value="leer">
                <input type="submit" value="Guardar">
            </form>';

        return $form;
    }
    
    public function store(Request $request){
        $input = $request->all();
        if ($request->get('id_publicacion') != "") {
            TblContactoPublicacion::create($input);
            
            $id_publicacion = $request->get('id_publicacion');
            $publicacion = Tbl_publicaciones::find($id_publicacion);
        
            
            
            $data = array(
                'name'=>$request['nombre'],
                'telefono'=>$request['telefono'],
                'texto'=>$request['descripcion'],
                'publicacion'=>$publicacion->titulo
     
                
                );
            Mail::send('email.email_contacto_publicacion', $data, function($message) {
                global $request;
                $message->to('matias@agrofans.com', 'AgroFans.com')->subject
                ('AgroFans.com | Contacto por publicacíon');
                $message->from($request['email'],$request['nombre']);
            });
            
            
            
            
            
            
        }else{
            $data = array(
                'name'=>$request['nombre'],
                'texto'=>$request['descripcion'],
                'telefono'=>$request['telefono']
                );
            Mail::send('email.email', $data, function($message) {
                global $request;
                $message->to('contacto@agrofans.com', 'AgroFans.com')->subject
                ('AgroFans.com | Contacto');
                $message->from($request['email'],$request['nombre']);
            });
        }
    }
}