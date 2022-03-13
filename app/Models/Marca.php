<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Marca extends Model
{
    use HasFactory;

    protected $fillable = ['nombre'];

    //Relacion uno a muchos
    public function modelos(){
        return $this->hasMany(Modelo::class);
    }

    public function productoSerialSucursals(){
        return $this->hasMany(ProductoSerialSucursal::class);
    }
}
