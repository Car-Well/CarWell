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

            $table->string('numero')->unique(); // ex: #0001

            $table->foreignId('cliente_id')->nullable()->constrained('clientes')->nullOnDelete();
            $table->foreignId('carro_id')->nullable()->constrained('carros')->nullOnDelete();

            // snapshots p/ não quebrar caso carro/cliente mudem
            $table->string('cliente_nome');
            $table->string('veiculo_nome');

            $table->string('pagamento'); // credito|debito|pix|boleto
            $table->decimal('valor', 12, 2);
            $table->string('status')->default('em_separacao'); // em_separacao|a_caminho|entregue|finalizado

            // Campos não-sensíveis do cartão (NÃO guardar número completo/cvv)
            $table->string('cartao_ultimos4', 4)->nullable();
            $table->string('cartao_nome')->nullable();
            $table->string('cartao_validade', 5)->nullable(); // MM/AA
            $table->unsignedTinyInteger('parcelas')->nullable();

            $table->timestamp('data_pedido')->useCurrent();
            $table->timestamps();

            $table->index(['status', 'data_pedido']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pedidos');
    }
};

