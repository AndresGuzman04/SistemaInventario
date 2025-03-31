<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Clente extends Model
{
    use HasFactory;
    public function persona(){
        return $this->belongsTo(Persona::class);
    }

    public function ventas(){
        return $this->hasMany(Venta::class);
    }
}
