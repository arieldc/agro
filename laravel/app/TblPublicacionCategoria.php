<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TblPublicacionCategoria extends Model
{
    //
    protected $table = 'tbl_publicacion_categoria';
    protected $fillable = [
        'id_categoria',
        'id_producto',
        'estado'
    ];
}
