<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblPublicacionCategoriaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_publicacion_categoria', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_categoria', false, true);
            $table->integer('id_producto', false, true);
            $table->enum('estado', ['activa', 'inactivo']);
            $table->timestamps();

            $table->foreign('id_categoria')->references('id')->on('tbl_categoria');
            $table->foreign('id_producto')->references('id')->on('tbl_publicaciones');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_publicacion_categoria');
    }
}
