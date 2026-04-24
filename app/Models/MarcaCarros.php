<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MarcaCarros extends Model
{
    
    public $fillable = ['name', 'image', 'model_id'];

    public function Model(){
        return $this->hasMany(Model::class);
    }
}
