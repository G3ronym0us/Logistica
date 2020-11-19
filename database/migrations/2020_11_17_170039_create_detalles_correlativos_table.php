<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetallesCorrelativosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalles_correlativos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('correlativo_id');
            $table->foreignId('catalogo_id');
            $table->bigInteger('cantidad');
            $table->bigInteger('subtotal');
            $table->timestamps();

            $table->foreign('correlativo_id')->references('id')->on('correlativos');
            $table->foreign('catalogo_id')->references('id')->on('catalogos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detalles_correlativos');
    }
}
