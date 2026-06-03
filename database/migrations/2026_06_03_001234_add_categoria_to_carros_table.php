<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCategoriaToCarrosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('carros', function (Blueprint $table) {
            $table->string('categoria')->nullable()->after('status');
        });
    }

    public function down()
    {
        Schema::table('carros', function (Blueprint $table) {
            $table->dropColumn('categoria');
        });
    }
}
