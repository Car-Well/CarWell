<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carro extends Model
{
    use HasFactory;

    protected $table = 'carros';

    protected $fillable = [
        'marca',
        'modelo',
        'ano',
        'cor',
        'km',
        'preco',
        'combustivel',
        'cambio',
        'status',
        'destacado',
        'descricao',
        'foto',
    ];

    protected $casts = [
        'ano' => 'integer',
        'km' => 'integer',
        'preco' => 'decimal:2',
    ];

    public function fotos()
    {
        return $this->hasMany(CarroFoto::class);
    }

    public function capa()
    {
        return $this->hasOne(CarroFoto::class)->where('is_capa', true);
    }

    public function getCapaPathAttribute(): ?string
    {
        return $this->capa ? $this->capa->path : $this->foto;
    }

    public function getVeiculoNomeAttribute(): string
    {
        return trim($this->marca . ' ' . $this->modelo);
    }

    public function getTipoAttribute(): string
    {
        $km  = (int) $this->km;
        $ano = (int) $this->ano;

        if ($km === 0) {
            return 'Novo';
        }

        if ($km < 30000 && ((int) date('Y') - $ano) <= 3) {
            return 'Seminovo';
        }

        return 'Usado';
    }
}

