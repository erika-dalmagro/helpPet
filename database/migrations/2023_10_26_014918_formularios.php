<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::dropIfExists('formularios');
        Schema::create('formularios', function (Blueprint $table) {
            $table->id();
            $table->int('id_pet');
            $table->string('nome');
            $table->text('documento')->nullable();
            $table->text('email')->nullable();
            $table->text('telefone')->nullable();
            $table->boolean('teve_pet')->nullable();
            $table->text('possui_animal')->nullable();
            $table->boolean('possui_espaco')->nullable();
            $table->boolean('ficara_sozinho')->nullable();
            $table->boolean('alergias')->nullable();
            $table->boolean('comprometimento_saude')->nullable();
            $table->boolean('avaliacao')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('formularios');
    }
};
