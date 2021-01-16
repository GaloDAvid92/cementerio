<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Boveda extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bovedas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre')->unique();
            $table->string('estado')->default('Disponible');
            $table->integer('filas');
            $table->integer('columnas');
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
        Schema::dropIfExists('bovedas');
    }
}
