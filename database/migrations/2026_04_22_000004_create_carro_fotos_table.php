<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('carro_fotos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('carro_id')->constrained('carros')->cascadeOnDelete();
            $table->string('path');
            $table->boolean('is_capa')->default(false);
            $table->unsignedSmallInteger('ordem')->default(0);
            $table->timestamps();

            $table->index(['carro_id', 'is_capa']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('carro_fotos');
    }
};

