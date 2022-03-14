<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sucursal extends Model
{
    use HasFactory;

    protected $guarded = ['id','created_at','updated_at'];

    //Relacion muchos a muchos
    public function productos(){
        return $this->belongsToMany(Producto::class);
    }

    //Relacion uno a muchos
   
    public function ventas(){
        return $this->hasMany(Venta::class);
    }
    public function producto_cod_barra_serials(){
        return $this->hasMany(Producto_cod_barra_serial::class);
    }

    public function users(){
        return $this->hasMany(User::class);
    }

    public function proformas(){
        return $this->hasMany(Proforma::class);
    }

    public function movimientoCajas(){
        return $this->hasMany(MovimientoCaja::class);
    }
}
