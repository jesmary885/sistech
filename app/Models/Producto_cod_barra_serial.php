<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto_cod_barra_serial extends Model
{
    use HasFactory;

    protected $guarded = ['id','created_at','updated_at'];

    //Relaion uno a muhos inversa
    public function producto(){
        return $this->belongsTo(Producto::class);
    }

    public function sucursal(){
        return $this->belongsTo(Sucursal::class);
    }

    //Relacion uno a muchos
   
    public function producto_ventas(){
        return $this->hasMany(Producto_venta::class);
    }
}
