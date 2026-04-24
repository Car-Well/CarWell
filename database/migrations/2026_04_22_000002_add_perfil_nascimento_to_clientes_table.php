<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('clientes', function (Blueprint $table) {
            $table->date('nascimento')->nullable()->after('password');
            $table->string('perfil')->default('cliente')->after('nascimento'); // cliente|admin|inativo
        });
    }

    public function down(): void
    {
        Schema::table('clientes', function (Blueprint $table) {
            $table->dropColumn(['nascimento', 'perfil']);
        });
    }
};

