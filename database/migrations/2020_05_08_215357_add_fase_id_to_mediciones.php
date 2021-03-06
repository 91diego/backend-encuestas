<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFaseIdToMediciones extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('mediciones', function (Blueprint $table) {
            $table->unsignedBigInteger("fase_id")->after("nombre");
            $table->foreign("fase_id")->references("id")->on("fases");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('mediciones', function (Blueprint $table) {
            //
        });
    }
}
