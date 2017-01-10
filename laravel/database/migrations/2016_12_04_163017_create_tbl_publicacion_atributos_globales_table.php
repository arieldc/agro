<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblPublicacionAtributosGlobalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_publicacion_atributos_globales', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_publicacion', false, true);
            $table->integer('id_atributo', false, true);
            $table->string('valor_atributo');
            $table->timestamps();

            $table->foreign('id_publicacion')->references('id')->on('tbl_publicaciones');
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
        Schema::dropIfExists('tbl_publicacion_atributos_globales');
    }
}
