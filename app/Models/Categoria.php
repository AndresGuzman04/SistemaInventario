<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{

    public function productos(){
        return $this->belongsToMany(Producto::class)->withTimestamps();
    }

    public function caracteritica(){
        return $this->belongsTo(Caracteristica::class);
    }

    protected $fillable = ['caracteristica_id'];
}
