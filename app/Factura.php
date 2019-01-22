<?php

namespace comercial;

use Illuminate\Database\Eloquent\Model;

class Factura extends Model
{
    protected $table='venta';
    protected $primaryKey='idventa';

    public $timestamps=false;

    protected $fillable = [
      'valorpago',
    ];

     protected $guarded =[
     
    ];
}
