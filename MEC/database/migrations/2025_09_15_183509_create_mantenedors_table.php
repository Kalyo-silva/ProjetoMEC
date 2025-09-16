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
        Schema::create('mantenedores', function (Blueprint $table) {
            $table->id();
            $table->string('nome', 200);
            $table->string('UF', 2)->nullable();
            $table->string('Cidade', 200)->nullable();
            $table->string('Bairro', 200)->nullable();
            $table->string('Logradouro', 200)->nullable();
            $table->string('CEP', 8)->nullable();
            $table->timestamp('data_criacao');
            $table->timestamp('data_alteracao');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mantenedores');
    }
};
