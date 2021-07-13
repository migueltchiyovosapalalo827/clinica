<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExameFisicoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exame_fisico', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('consulta_id');
            $table->foreign('consulta_id')->references('id')
            ->on('prontuario')
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->unsignedBigInteger('prontuario_id');
            $table->foreign('prontuario_id')->references('id')
            ->on('prontuario')
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->float('peso');
            $table->float('altura');
            $table->float('pressao_arterial_sistolica');
            $table->float('pressao_arterial_diastolica');
            $table->float('frequencia_cardiaca');
            $table->string('observacao_gerais',255);
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
        Schema::dropIfExists('exame_fisico');
    }
}
