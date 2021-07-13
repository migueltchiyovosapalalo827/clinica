<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHepotiseDiagnosticaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hepotise_diagnostica', function (Blueprint $table) {
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
            $table->string('hipotise',255);
            $table->string('tipo_exame',255);
            $table->string('diagnostico_final');
            $table->boolean('solicitar_exame');
            $table->boolean('requer_iternacao');
            $table->boolean('reque_urgencia');
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
        Schema::dropIfExists('hepotise_diagnostica');
    }
}
