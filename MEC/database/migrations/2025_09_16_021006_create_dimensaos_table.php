<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('dimensoes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_instrumento')->references('id')->on('instrumentos');
            $table->integer('sequencia');
            $table->text('descricao');
            $table->timestamp('data_criacao');
            $table->timestamp('data_alteracao');

            $table->unique(['id_instrumento', 'sequencia']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dimensoes');
    }
};
