<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exames', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('hepotise_diagnostica_id');
            $table->foreign('hepotise_diagnostica_id')->references('id')
            ->on('hepotise_diagnostica')
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->string('nome_exame');
            $table->string('material_analizado');
            $table->string('finalidade');
            $table->string('preparacao_previa');
            $table->string('valor_normais_descricao');
            $table->string('valor_arormaais_segnifica');
            $table->string('nivel_confiablidade');
            $table->string('descricao_exame');
            $table->integer('prazo_resultado');
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
        Schema::dropIfExists('exames');
    }
}
