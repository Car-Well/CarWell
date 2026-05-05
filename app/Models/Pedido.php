<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;

    protected $table = 'pedidos';

    protected $fillable = [
        'cliente_id',
        'carro_id',
        'status',
        'pagamento',
        'valor',
        'cartao_nome',
        'cartao_ultimos4',
        'parcelas',
    ];

    protected $casts = [
        'valor'    => 'decimal:2',
        'parcelas' => 'integer',
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function carro()
    {
        return $this->belongsTo(Carro::class);
    }

    public function getNumeroAttribute(): string
    {
        return '#' . str_pad($this->id, 4, '0', STR_PAD_LEFT);
    }
}