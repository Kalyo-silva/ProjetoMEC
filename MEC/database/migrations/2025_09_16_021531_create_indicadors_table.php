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
        Schema::create('indicadores', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_dimensao')->references('id')->on('dimensoes');
            $table->integer('sequencia');
            $table->text('descricao');
            $table->timestamp('data_criacao');
            $table->timestamp('data_alteracao');

            $table->unique(['id_dimensao', 'sequencia']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('indicadores');
    }
};
