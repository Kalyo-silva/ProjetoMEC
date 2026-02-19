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
        Schema::create('avaliacao', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_instrumento')->references('id')->on('instrumento');
            $table->foreignId('id_curso')->references('id')->on('curso');
            $table->smallInteger('ano');
            $table->text('descricao');
            $table->date('data_inicio');
            $table->date('data_fim');
            $table->foreignId('id_usuario')->references('id')->on('users');
            $table->timestamp('data_criacao');
            $table->timestamp('data_alteracao');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('avaliacao');
    }
};
