<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGerenciamentoCarrosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gerenciamento_carros', function (Blueprint $table) {
            $table->id();
            
            $table->timestamps();
        });
    }
    // public $fillable = ['brand', 'model', 'year', 'color', 'km', 'value', 'fuel', 'gearbox', 'status', 'description', 'photo'];

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gerenciamento_carros');
    }
}
