<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblPublicacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_publicaciones', function (Blueprint $table) {
            $table->increments('id');
            $table->string('titulo');
            $table->decimal('precio', 15, 4);
            $table->string('descripcion');
            $table->enum('estado', ['activo', 'pausa', 'inactivo']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_publicaciones');
    }
}
