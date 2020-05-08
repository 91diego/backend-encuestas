<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNegociacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('negociaciones', function (Blueprint $table) {
            $table->id();
            $table->integer("id_negociacion");
            $table->string("desarrollo");
            $table->string("responsable");
            $table->string("puesto_responsable");
            $table->string("departamento_responsable");
            $table->string("gerente_responsable");
            $table->string("origen");
            $table->string("canal_ventas");
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
        Schema::dropIfExists('negociaciones');
    }
}
