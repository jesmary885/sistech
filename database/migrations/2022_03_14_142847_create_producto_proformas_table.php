<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductoProformasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('producto_proformas', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('proforma_id');
            $table->foreign('proforma_id')->references('id')->on('proformas');
            $table->unsignedBigInteger('producto_serial_sucursal_id');
            $table->foreign('producto_serial_sucursal_id')->references('id')->on('producto_serial_sucursals');
            $table->float('precio');
            $table->string('cantidad');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('producto_proformas');
    }
}
