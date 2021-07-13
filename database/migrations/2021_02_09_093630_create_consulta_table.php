<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConsultaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consulta', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('profissional_saude_id');
            $table->foreign('profissional_saude_id')->references('id')
            ->on('profissional_saude')
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->timestamp('inicio_atendimento');
            $table->timestamp('fim_atendimento');
            $table->date('data_atendimento');
            $table->boolean('solicitar_retorno');
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
        Schema::dropIfExists('consulta');
    }
}
