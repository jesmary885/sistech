<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto_venta extends Model
{
    use HasFactory;

    protected $guarded = ['id','created_at','updated_at'];

    //Relaion uno a muhos inversa
    public function venta(){
        return $this->belongsTo(Venta::class);
    }

    public function producto_cod_barra_serial(){
        return $this->belongsTo(Producto_cod_barra_serial::class);
    }
}
