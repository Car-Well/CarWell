<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MarcaCarros extends Model
{
    protected $table = 'marca_carros';

    protected $fillable = ['nome', 'logo'];
}
