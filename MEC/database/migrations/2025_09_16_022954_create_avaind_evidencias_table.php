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
        Schema::create('avaind_evidencia', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_avaliacao_indicador')->references('id')->on('avaliacao_indicador');
            $table->foreignId('id_evidencia')->references('id')->on('evidencia');
            $table->timestamp('data_criacao');
            $table->timestamp('data_alteracao');

            $table->unique(['id_avaliacao_indicador', 'id_evidencia']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('avaind_evidencia');
    }
};
