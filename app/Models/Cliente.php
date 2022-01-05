<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $guarded = ['id','created_at','updated_at'];

    //Relaion uno a muhos inversa
    public function pais(){
        return $this->belongsTo(Pais::class);
    }

    public function ciudad(){
        return $this->belongsTo(Ciudad::class);
    }

    public function estado(){
        return $this->belongsTo(Estado::class);
    }

     //Relacion uno a muchos
   
     public function ventas(){
        return $this->hasMany(Venta::class);
    }

    
}
