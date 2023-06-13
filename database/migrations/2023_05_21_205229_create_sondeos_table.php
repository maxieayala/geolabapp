<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sondeos', function (Blueprint $table) {
            $table->id();
            $table->double('coordenada_x');
            $table->double('coordenada_y');
            $table->string('estacion', 8)->nullable();
            $table->string('banda', 5)->nullable();
            $table->unsignedBigInteger('tipo_sondeo_id')->nullable();
            $table->unsignedBigInteger('proyecto_id');
            $table->foreign('proyecto_id')->references('id')->on('proyectos');
            $table->date('fecha')->nullable();
            $table->string('metodos_perforacion')->nullable();
            $table->string('instrumentacion')->nullable();
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
        Schema::dropIfExists('sondeos');
    }
};
