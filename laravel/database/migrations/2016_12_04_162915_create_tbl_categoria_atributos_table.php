<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblCategoriaAtributosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_categoria_atributos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_categoria', false, true);
            $table->integer('id_atributo', false, true);
            $table->enum('estado', ['activo', 'inactivo']);
            $table->timestamps();

            $table->foreign('id_categoria')->references('id')->on('tbl_categoria');
            $table->foreign('id_atributo')->references('id')->on('tbl_atributos_globales');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_categoria_atributos');
    }
}
