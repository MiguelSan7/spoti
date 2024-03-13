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
        Schema::create('descargas', function (Blueprint $table) {
            $table->id();
            $table->string('codigo', 100);
            $table->unsignedBigInteger('id_usuario');
            $table->unsignedBigInteger('id_cancion');
            $table->foreign('id_usuario')->references('id')->on('users');
            $table->foreign('id_cancion')->references('id')->on('canciones');
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
        Schema::dropIfExists('descargas');
    }
};
