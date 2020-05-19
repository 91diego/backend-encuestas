<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnvioEncuestasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('envio_encuestas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("encuesta_id");
            $table->foreign("encuesta_id")->references("id")->on("encuestas");
            $table->unsignedBigInteger("negociacion_id");
            $table->foreign("negociacion_id")->references("id")->on("negociaciones");
            $table->string('estatus_envio');
            $table->string('fecha_envio');
            $table->string('estatus_respuesta')->nullable();
            $table->string('fecha_respuesta')->nullable();
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
        Schema::dropIfExists('envio_encuestas');
    }
}
