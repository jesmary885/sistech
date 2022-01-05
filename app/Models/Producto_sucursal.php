<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto_sucursal extends Model
{
    use HasFactory;

    protected $table = "producto_sucursal";

    //Relacion uno a mucos inversa

    public function producto(){
        return $this->belongsTo(Producto::class);
    }

    public function sucursal(){
        return $this->belongsTo(Sucursal::class);
    }
}
