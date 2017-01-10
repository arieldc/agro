<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tbl_Categoria extends Model
{
    //
    protected $table = 'tbl_categoria';
    protected $fillable = [
        'nombre',
        'id_padre',
        'orden',
        'estado'
    ];
    
    public function parent(){
        return $this->hasOne('App\Tbl_Categoria', 'id', 'id_padre');
    }

    public function children(){
        return $this->hasMany('App\Tbl_Categoria', 'id_padre', 'id');
    }
    
    public function categoriaAtributos(){
        return $this->belongsToMany('App\TblAtributosGlobales', 'tbl_categoria_atributos', 'id_categoria', 'id_atributo');

    }
    public function countAtributos($id){
        return $this->hasMany('App\TblCategoriaAtributos', 'id_categoria', 'id')->where('tbl_categoria_atributos.id_categoria', '=', "$id");
    }

    public static function tree(){
        return static::with(implode('.', array_fill(0, 100, 'children')))->where('id_padre', '=', '0')->get();
    }
}
