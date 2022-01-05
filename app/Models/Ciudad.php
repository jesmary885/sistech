<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ciudad extends Model
{
    use HasFactory;
    protected $fillable = ['nombre'];

    //Relaion uno a muhos inversa
    public function pais(){
        return $this->belongsTo(Pais::class);
    }

    //Relacion uno a muchos
    public function estados(){
        return $this->hasMany(Estado::class);
    }

    public function clientes(){
        return $this->hasMany(Cliente::class);
    }

    public function proveedors(){
        return $this->hasMany(Proveedor::class);
    }

    public function users(){
        return $this->hasMany(User::class);
    }

}
