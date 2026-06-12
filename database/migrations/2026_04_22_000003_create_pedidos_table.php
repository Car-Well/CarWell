<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pedidos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cliente_id')->constrained('clientes')->cascadeOnDelete();
            $table->foreignId('carro_id')->constrained('carros')->cascadeOnDelete();
            $table->string('status')->default('em_separacao');
            $table->string('pagamento');
            $table->decimal('valor', 12, 2);
            $table->string('cartao_nome')->nullable();
            $table->string('cartao_ultimos4', 4)->nullable();
            $table->unsignedTinyInteger('parcelas')->nullable();
            $table->timestamps();

            $table->index('status');
            $table->index('cliente_id');
            $table->index('carro_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pedidos');
    }
};