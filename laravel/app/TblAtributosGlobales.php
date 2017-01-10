<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TblAtributosGlobales extends Model
{
    //
    protected $table = 'tbl_atributos_globales';
    protected $fillable = [
        'nombre',
        'elemento',
        'orden',
        'requerido'
    ];
    
    public function atrGlobalValores(){
        return $this->hasMany('App\TblAtributosGlobalesValores', 'id_atributos_globales');
    }

    public function publicaciones(){
        $pp = $this->belongsToMany('App\Tbl_publicaciones', 'tbl_publicacion_atributos_globales', 'id_atributo', 'id_publicacion')->withPivot('id','valor_atributo');
        return $pp;
    }
}
