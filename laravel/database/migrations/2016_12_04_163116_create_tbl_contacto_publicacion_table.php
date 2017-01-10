<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblContactoPublicacionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_contacto_publicacion', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_publicacion', false, true);
            $table->string('nombre');
            $table->string('apellido');
            $table->string('email');
            $table->integer('telefono', false, false);
            $table->string('descripcion');
            $table->enum('estado', ['leer', 'inactivo', 'leido', 'respondido']);
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
        Schema::dropIfExists('tbl_contacto_publicacion');
    }
}
