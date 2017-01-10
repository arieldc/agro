<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblAtributosGlobalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_atributos_globales', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->enum('elemento', ['input', 'textarea', 'selectbox', 'multiselectbox', 'radio', 'checkbox', 'checkboxgroup', 'file', 'hidden']);
            $table->enum('requerido', ['1', '2']);
            $table->integer('orden');
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
        Schema::dropIfExists('tbl_atributos_globales');
    }
}
