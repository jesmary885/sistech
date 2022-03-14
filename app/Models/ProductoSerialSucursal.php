<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductoSerialSucursal extends Model
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

    public function compra(){
        return $this->belongsTo(Sucursal::class);
    }

    public function modelo(){
        return $this->belongsTo(Modelo::class);
    }

    public function marca(){
        return $this->belongsTo(Marca::class);
    }

    //Relacion uno a muchos
   
    /*public function producto_ventas(){
        return $this->hasMany(Producto_venta::class);
    }*/

    public function producto_ventas(){
        return $this->hasMany(Producto_venta::class);
    }

    public function producto_proformas(){
        return $this->hasMany(Producto_proforma::class);
    }

    public function movimientos(){
        return $this->hasMany(Movimiento_product_serial::class);
    }

    
    public function productostraslados(){
        return $this->hasMany(ProductosTraslado::class);
    }

}
