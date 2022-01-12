<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $guarded = ['id','created_at','updated_at'];

    //Relaion uno a muhos inversa
    public function categoria(){
        return $this->belongsTo(Categoria::class);
    }

    public function modelo(){
        return $this->belongsTo(Modelo::class);
    }

    //Relacion uno a muchos
   
    public function producto_cod_barra_serials(){
        return $this->hasMany(Producto_cod_barra_serial::class);
    }
    public function compras(){
        return $this->hasMany(Compra::class);
    }

    public function movimientos(){
        return $this->hasMany(Movimiento::class);
    }

    //Relacion muchos a muchos
    public function sucursals(){
        return $this->belongsToMany(Sucursal::class)->withPivot('cantidad', 'id', 'producto_id');;
    }

    //relacion 1 a 1 polimorfica
    public function imagen(){
        return $this->morphOne('App\Models\Imagen','imageable');
    }

    
  

}
