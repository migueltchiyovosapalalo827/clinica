<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDadospessoaisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dados_pessoais', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->string('nome');
            $table->date('data_nasc');
            $table->string('sexo');
            $table->string('email')->unique();
            $table->string('email_secundario')->nullable();
            $table->string('observacoes',255)->nullable();
            $table->integer('telefone');
            $table->integer('telefone_secundario')->nullable(); 
            $table->integer('bi');
            $table->string('endereco',255);
            $table->string('nacionalidade',100)->nullable();
            $table->string('provincia',100);
            $table->string('municipio',100);
            $table->string('bairro',100);
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
        Schema::dropIfExists('dados_pessoais');
    }
}
