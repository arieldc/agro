<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblAtributosGlobalesValoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_atributos_globales_valores', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_atributos_globales', false, true);
            $table->string('value_vista');
            $table->enum('estado', ['activo', 'inactivo']);
            $table->timestamps();

            $table->foreign('id_atributos_globales')->references('id')->on('tbl_atributos_globales');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_atributos_globales_valores');
    }
}
