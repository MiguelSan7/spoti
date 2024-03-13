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
        Schema::create('canciones', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 100);
            $table->unsignedBigInteger('album_id');
            $table->foreign('album_id')->references('id')->on('albumes')->onDelete('cascade');
            $table->unsignedBigInteger('genero_id');
            $table->foreign('genero_id')->references('id')->on('generos')->onDelete('cascade');
            $table->boolean('estado')->default(true);
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
        Schema::dropIfExists('canciones');
    }
};
