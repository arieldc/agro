<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TblPublicacionAtributosGlobales extends Model
{
    //
    protected $table = 'tbl_publicacion_atributos_globales';
    protected $fillable = [
        'id_publicacion',
        'id_atributo',
        'valor_atributo'
    ];

    public function atributosPublicaciones(){
        return $this->belongsTo('App\Tbl_publicaciones', 'id_publicacion');
    }
}
