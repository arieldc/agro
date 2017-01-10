<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TblAtributosGlobalesValores extends Model
{
    //
    protected $table = 'tbl_atributos_globales_valores';
    protected $fillable = [
        'id_atributos_globales',
        'value_vista',
        'estado'
    ];
}
