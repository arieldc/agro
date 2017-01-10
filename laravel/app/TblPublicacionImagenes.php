<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TblPublicacionImagenes extends Model
{
    //
    protected $table = 'tbl_publicacion_imagenes';
    protected $fillable = [
        'id_publicacion',
        'ruta',
        'estado'
    ];
}
