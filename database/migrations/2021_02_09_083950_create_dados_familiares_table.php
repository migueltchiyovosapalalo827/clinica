<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDadosFamiliaresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dados_familiares', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('dados_complementares_id');
            $table->foreign('dados_complementares_id')->references('id')->on('dados_complementares')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->string('nome');
            $table->integer('idade');
            $table->string('sexo');
            $table->string('parentesco');
            $table->string('email')->unique();
            $table->string('telefone');
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
        Schema::dropIfExists('dados_familiares');
    }
}
