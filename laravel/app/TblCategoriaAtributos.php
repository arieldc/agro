<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TblCategoriaAtributos extends Model
{
    //
    protected $table = 'tbl_categoria_atributos';
    protected $fillable = [
        'id_categoria',
        'id_atributo',
        'estado'
    ];

    
}
