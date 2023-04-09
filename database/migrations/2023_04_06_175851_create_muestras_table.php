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
        Schema::create('muestras', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('estacion', 8)->nullable();
            $table->string('latitud', 15)->nullable();
            $table->string('longitud', 15)->nullable();
            $table->string('banda', 5)->nullable();
            $table->integer('sondeo')->nullable();
            $table->decimal('desde')->nullable();
            $table->decimal('hasta')->nullable();
            $table->string('descripcionvisual')->nullable();
            $table->unsignedBigInteger('estudio_id');
            $table->foreign('estudio_id')->references('id')->on('estudios');
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
        Schema::dropIfExists('muestra');
    }
};
