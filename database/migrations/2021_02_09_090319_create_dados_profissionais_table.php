<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDadosProfissionaisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dados_profissionais', function (Blueprint $table) {
            $table->id();
            $table->string('tipo_conselho',100);
            $table->integer('numero_registro');
            $table->string('profissao',100);
            $table->string('especialidade',100);
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
        Schema::dropIfExists('dados_profissionais');
    }
}
