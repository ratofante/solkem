<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Turno extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('turno', function (Blueprint $table) {
            $table->increments('id');
            $table->dateTime('fechaHora')->nullable();
            $table->tinyInteger('paraEntrega')->nullable();
            $table->unsignedInteger('orden_id');
            $table->unsignedInteger('sucursal_id')->nullable();

            $table->foreign('orden_id')->references('id')->on('orden')->onDelete('cascade');
            $table->foreign('sucursal_id')->references('id')->on('sucursal')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('turno');
    }
}
