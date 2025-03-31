<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;

    public function productos(){
        return $this->belongsToMany(Producto::class)->withTimestamps();
    }

    public function caracteritica(){
        return $this->belongsTo(Caracteristica::class);
    }
}
