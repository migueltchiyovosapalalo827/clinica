<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnamneseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('anamnese', function (Blueprint $table) {
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
            $table->string('queixa_principal',255);
            $table->string('problemas_renais',255);
            $table->string('problemas_resperatorios',255);
            $table->string('reumastismo',255);
            $table->string('alergias',255);
            $table->string('problemas_grasticos',255);
            $table->mediumText('historia');
            $table->boolean('hepatite');
            $table->boolean('diabetes');
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
        Schema::dropIfExists('anamnese');
    }
}
