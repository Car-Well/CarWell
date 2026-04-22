<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;

    protected $table = 'pedidos';

    protected $fillable = [
        'numero',
        'cliente_id',
        'carro_id',
        'cliente_nome',
        'veiculo_nome',
        'pagamento',
        'valor',
        'status',
        'cartao_ultimos4',
        'cartao_nome',
        'cartao_validade',
        'parcelas',
        'data_pedido',
    ];

    protected $casts = [
        'valor' => 'decimal:2',
        'parcelas' => 'integer',
        'data_pedido' => 'datetime',
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function carro()
    {
        return $this->belongsTo(Carro::class);
    }
}

