<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNomeLogoToMarcaCarrosTable extends Migration
{
    public function up()
    {
        Schema::table('marca_carros', function (Blueprint $table) {
            $table->string('nome')->unique()->after('id');
            $table->string('logo')->nullable()->after('nome');
        });
    }

    public function down()
    {
        Schema::table('marca_carros', function (Blueprint $table) {
            $table->dropColumn(['nome', 'logo']);
        });
    }
}
