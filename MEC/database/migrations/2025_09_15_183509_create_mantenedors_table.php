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
        Schema::create('mantenedor', function (Blueprint $table) {
            $table->id();
            $table->string('nome', 200);
            $table->string('uf', 2)->nullable();
            $table->string('cidade', 200)->nullable();
            $table->string('bairro', 200)->nullable();
            $table->string('logradouro', 200)->nullable();
            $table->string('cep', 8)->nullable();
            $table->timestamp('data_criacao');
            $table->timestamp('data_alteracao');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mantenedor');
    }
};
