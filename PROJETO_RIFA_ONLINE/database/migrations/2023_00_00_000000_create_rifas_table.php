<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('rifas', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->text('descricao');
            $table->decimal('preco_bilhete', 10, 2);
            $table->integer('quantidade_bilhetes');
            $table->integer('bilhetes_disponiveis');
            $table->dateTime('data_sorteio');
            $table->enum('status', ['ativa', 'encerrada', 'sorteada']);
            $table->string('imagem_premio')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('rifas');
    }
};