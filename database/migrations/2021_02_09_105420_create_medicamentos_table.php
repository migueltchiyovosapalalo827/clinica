<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicamentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medicamentos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('prescricoes_id');
            $table->foreign('prescricoes_id')->references('id')
            ->on('prescricoes')
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->string('nome_medicamento');
            $table->string('apresentacao');
            $table->string('unidade');
            $table->string('valor');
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
        Schema::dropIfExists('medicamentos');
    }
}
