<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNascimentoPerfilToClientesTable extends Migration
{
    public function up()
    {
        Schema::table('clientes', function (Blueprint $table) {
            if (!Schema::hasColumn('clientes', 'nascimento')) {
                $table->date('nascimento')->nullable();
            }
            if (!Schema::hasColumn('clientes', 'perfil')) {
                $table->string('perfil')->default('cliente');
            }
        });
    }

    public function down()
    {
        Schema::table('clientes', function (Blueprint $table) {
            $table->dropColumn(['nascimento', 'perfil']);
        });
    }
}
