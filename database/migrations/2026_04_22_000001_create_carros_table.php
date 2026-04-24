<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('carros', function (Blueprint $table) {
            $table->id();

            $table->string('marca');
            $table->string('modelo');
            $table->unsignedSmallInteger('ano');
            $table->string('cor')->nullable();
            $table->unsignedInteger('km')->nullable();

            $table->decimal('preco', 12, 2);

            $table->string('combustivel')->nullable(); // flex|gasolina|diesel|eletrico|hibrido
            $table->string('cambio')->nullable(); // manual|automatico|cvt
            $table->string('status')->default('disponivel'); // disponivel|reservado|vendido

            $table->text('descricao')->nullable();
            $table->string('foto')->nullable(); // caminho no storage/public

            $table->timestamps();

            $table->index(['status']);
            $table->index(['marca', 'modelo', 'ano']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('carros');
    }
};

