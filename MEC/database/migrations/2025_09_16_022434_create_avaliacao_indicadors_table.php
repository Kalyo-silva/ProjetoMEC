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
        Schema::create('avaliacao_indicadores', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_avaliacao')->references('id')->on('avaliacoes');
            $table->foreignId('id_indicador')->references('id')->on('indicadores');
            $table->timestamp('data_criacao');
            $table->timestamp('data_alteracao');

            $table->unique(['id_avaliacao', 'id_indicador']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('avaliacao_indicadores');
    }
};
