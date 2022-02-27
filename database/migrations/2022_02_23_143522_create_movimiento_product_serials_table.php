<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMovimientoProductSerialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movimiento_product_serials', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->date('fecha');
            $table->string('tipo_movimiento');
            $table->float('precio');
            $table->string('observacion');
            $table->unsignedBigInteger('producto_serial_sucursal_id');
            $table->foreign('producto_serial_sucursal_id')->references('id')->on('producto_serial_sucursals')->onDelete('cascade');;
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('movimiento_product_serials');
    }
}
