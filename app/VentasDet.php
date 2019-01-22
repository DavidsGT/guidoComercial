<?php

namespace comercial;

use Illuminate\Database\Eloquent\Model;

class VentasDet extends Model
{
    //
      protected $table='detalle_venta';
    protected $primaryKey='iddetalle_venta';

    public $timestamps=false;

    protected $fillable = [
    'estado'
    ];

     protected $guarded =[
     
    ];
}
