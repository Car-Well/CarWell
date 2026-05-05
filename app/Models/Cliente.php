<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Cliente extends Authenticatable
{
    use Notifiable;

    protected $guard = 'cliente';

    protected $fillable = [
        'name',
        'telefone',
        'email',
        'password',
        'nascimento',
        'perfil',
        'foto',
        'endereco',
        'email_verification_code',
        'email_verification_expires_at',
        'email_verified_at',
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'email_verification_code',
    ];

    protected $casts = [
        'email_verified_at'             => 'datetime',
        'email_verification_expires_at' => 'datetime',
        'nascimento'                    => 'date',
    ];

    public function pedidos()
    {
        return $this->hasMany(Pedido::class);
    }

    public function getInitialsAttribute(): string
    {
        $parts = explode(' ', trim($this->name));
        return strtoupper(($parts[0][0] ?? '') . ($parts[1][0] ?? ''));
    }
}