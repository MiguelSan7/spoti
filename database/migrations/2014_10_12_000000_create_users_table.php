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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('nombres');
            $table->string('apellidos');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->timestamp('activated_at')->nullable();
            $table->string('password');
            $table->unsignedBigInteger('id_rol')->default(3);
            $table->foreign('id_rol')->references('id')->on('roles');
            $table->unsignedBigInteger('id_suscripcion')->default(1);
            $table->foreign('id_suscripcion')->references('id')->on('suscripciones');
            $table->boolean('estado')->default(false);
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};
