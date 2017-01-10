<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TblContactoPublicacion extends Model
{
    //
    protected $table = 'tbl_contacto_publicacion';
    protected $fillable = [
        'id_publicacion',
        'nombre',
        'apellido',
        'email',
        'telefono',
        'descripcion',
        'estado'
    ];

    public function publicacion(){
        return $this->belongsTo('App\Tbl_publicaciones', 'id_publicacion', 'id');
    }


}
