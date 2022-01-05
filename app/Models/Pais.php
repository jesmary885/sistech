<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pais extends Model
{
    use HasFactory;

    protected $fillable = ['nombre'];

    //Relacion uno a muchos
    public function ciudads(){
        return $this->hasMany(Ciudad::class);
    }

    public function clientes(){
        return $this->hasMany(Cliente::class);
    }

    public function proveedors(){
        return $this->hasMany(Proveedor::class);
    }
}
