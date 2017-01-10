<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
class Tbl_publicaciones extends Model
{
    //
    protected $table = 'tbl_publicaciones';
    protected $fillable = [
        'titulo',
        'tipo_moneda',
        'precio',
        'descripcion',
        'estado'
    ];

    public function publicacionImagen(){
        return $this->hasMany('App\TblPublicacionImagenes', 'id_publicacion');
    }

    public function publicacionCategoria(){
        return $this->belongsToMany('App\Tbl_Categoria', 'tbl_publicacion_categoria', 'id_producto', 'id_categoria');
    }

    public function publicacionAtributos(){
        return $this->belongsToMany('App\TblAtributosGlobales', 'tbl_publicacion_atributos_globales', 'id_publicacion', 'id_atributo')->withPivot('id','valor_atributo');
    }
}
