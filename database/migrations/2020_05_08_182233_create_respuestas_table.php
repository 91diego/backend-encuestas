<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRespuestasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('respuestas', function (Blueprint $table) {
            $table->id();
            $table->string("respuesta");
            $table->unsignedBigInteger("pregunta_id");
            $table->unsignedBigInteger("negociacion_id");
            $table->foreign("pregunta_id")->references("id")->on("preguntas");
            $table->foreign("negociacion_id")->references("id")->on("negociaciones");
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
        Schema::dropIfExists('respuestas');
    }
}
