<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAddressFieldsToClientesTable extends Migration
{
    public function up()
    {
        Schema::table('clientes', function (Blueprint $table) {
            $table->string('cep', 9)->nullable()->after('endereco');
            $table->string('rua')->nullable()->after('cep');
            $table->string('bairro')->nullable()->after('rua');
            $table->string('cidade')->nullable()->after('bairro');
            $table->string('estado', 2)->nullable()->after('cidade');
            $table->string('numero', 20)->nullable()->after('estado');
            $table->string('complemento')->nullable()->after('numero');
            $table->string('ponto_referencia')->nullable()->after('complemento');
        });
    }

    public function down()
    {
        Schema::table('clientes', function (Blueprint $table) {
            $table->dropColumn(['cep', 'rua', 'bairro', 'cidade', 'estado', 'numero', 'complemento', 'ponto_referencia']);
        });
    }
}
