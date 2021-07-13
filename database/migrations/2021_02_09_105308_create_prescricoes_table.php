<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrescricoesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prescricoes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('consulta_id');
            $table->foreign('consulta_id')->references('id')
            ->on('consulta')
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->unsignedBigInteger('prontuario_id');
            $table->foreign('prontuario_id')->references('id')
            ->on('prontuario')
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->date('data_prescricao');
            $table->string('prescrever_medicamento');
            $table->string('descricao');
            $table->string('posologia');
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
        Schema::dropIfExists('prescricoes');
    }
}
