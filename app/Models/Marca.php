<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Marca extends Model
{
    use HasFactory;
    
    public function productos(){
        return $this->hasMany(Producto::class);
    }

    public function caracteritica(){
        return $this->belongsTo(Caracteristica::class);
    }
}
