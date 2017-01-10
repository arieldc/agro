<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblPublicacionImagenesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_publicacion_imagenes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_publicacion', false, true);
            $table->string('ruta');
            $table->enum('estado', ['activo', 'pausa', 'inactivo']);
            $table->timestamps();

            $table->foreign('id_publicacion')->references('id')->on('tbl_publicaciones');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_publicacion_imagenes');
    }
}
