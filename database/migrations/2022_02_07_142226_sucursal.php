<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class Sucursal extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sucursal', function(Blueprint $table) {
            $table->increments('id');
            $table->time('apertura')->nullable();
            $table->time('cierre')->nullable();
            $table->string('nombre', 45);
            $table->string('direccion');
            $table->string('telefono', 45);
            $table->string('email',45);
        });
        DB::table('sucursal')->insert([
            'nombre' => 'sin definir',
            'direccion' => '-',
            'telefono' => '-',
            'email'=>'-'
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sucursal');
    }
}
