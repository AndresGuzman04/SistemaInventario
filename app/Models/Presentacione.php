<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Presentacione extends Model
{
    use HasFactory;
    
    public function productos(){
        return $this->belongsToMany(Producto::class);
    }

    public function caracteritica(){
        return $this->belongsTo(Caracteristica::class);
    }
}
