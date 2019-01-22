<?php

namespace comercial;

use Illuminate\Database\Eloquent\Model;

class DetalleVentas extends Model
{
    //
     protected $table='detalle_venta';
    protected $primaryKey='iddetalle_venta';

    public $timestamps=false;

    protected $fillable = [
    'idventa',
    'idarticulo',
    'cantidad',
	'precio_venta',
	'descuento'
	];
     protected $guarded =[
     
    ];
}
