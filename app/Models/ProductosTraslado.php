<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductosTraslado extends Model
{
    use HasFactory;

    protected $guarded = ['id','created_at','updated_at'];

    //Relaion uno a muhos inversa

    public function sucursal(){
        return $this->belongsTo(Sucursal::class);
    }

    public function productoSerialSucursal(){
        return $this->belongsTo(ProductoSerialSucursal::class);
    }
}
