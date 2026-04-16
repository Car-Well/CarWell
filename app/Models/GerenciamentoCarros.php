<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GerenciamentoCarros extends Model
{
    public $fillable = ['brand_id', 'year', 'color', 'km', 'value', 'fuel', 'gearbox', 'status', 'description', 'image'];

    public function Brand(){
        return $this->belongsTo(Brand::class);
    }

}
