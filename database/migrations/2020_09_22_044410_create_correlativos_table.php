<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCorrelativosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('correlativos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('municipio_id');
            $table->string('n_partida', 100);
            $table->string('proyecto', 100);
            $table->foreignId('beneficiario_id');
            $table->bigInteger('orden_compra');
            $table->timestamps();

            $table->foreign('municipio_id')->references('id')->on('municipios');
            $table->foreign('beneficiario_id')->references('id')->on('beneficiarios');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('correlativos');
    }
}
