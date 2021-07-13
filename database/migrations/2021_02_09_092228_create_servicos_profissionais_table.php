<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicosProfissionaisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('servicos_profissionais', function (Blueprint $table) {
            
           $table->unsignedBigInteger('profissional_saude_id');
            $table->foreign('profissional_saude_id')->references('id')->on('profissional_saude')
            ->onUpdate('cascade')
            ->onDelete('cascade');

            $table->unsignedBigInteger('servicos_medico_id');
            $table->foreign('servicos_medico_id')->references('id')->on('servicos_medicos')
                ->onUpdate('cascade')
                ->onDelete('cascade');
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
        Schema::dropIfExists('servicos_profissionais');
    }
}
