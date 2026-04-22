<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarroFoto extends Model
{
    use HasFactory;

    protected $table = 'carro_fotos';

    protected $fillable = [
        'carro_id',
        'path',
        'is_capa',
        'ordem',
    ];

    protected $casts = [
        'is_capa' => 'boolean',
        'ordem' => 'integer',
    ];

    public function carro()
    {
        return $this->belongsTo(Carro::class);
    }
}

