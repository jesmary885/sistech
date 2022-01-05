<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('nombre');
            $table->string('inventario_min');
            $table->string('precio_entrada');
            $table->string('precio_letal');
            $table->string('precio_mayor');
            $table->string('serial');
            $table->string('tipo_garantia');
            $table->string('cod_barra');
            $table->string('estado');
            $table->string('presentacion');
            $table->string('garantia');
            $table->string('cantidad');
            $table->string('percepcion');
            $table->string('observaciones');
            $table->unsignedBigInteger('categoria_id');
            $table->foreign('categoria_id')->references('id')->on('categorias');
            $table->unsignedBigInteger('modelo_id');
            $table->foreign('modelo_id')->references('id')->on('modelos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('productos');
    }
}
