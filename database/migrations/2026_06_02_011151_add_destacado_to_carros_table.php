<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDestacadoToCarrosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('carros', function (Blueprint $table) {
            $table->boolean('destacado')->default(false)->after('status');
        });
    }

    public function down()
    {
        Schema::table('carros', function (Blueprint $table) {
            $table->dropColumn('destacado');
        });
    }
}
