<?php

namespace comercial;

use Illuminate\Database\Eloquent\Model;

class Devolucion extends Model
{
    protected $table='devolucion';
    protected $primaryKey='iddetorden';

    public $timestamps=false;

    protected $fillable = [
    'iddetorden',
    'idingreso',
    'fechapago',
    'proveedor',
    'valdeuda',
    'cantidad',
    'articulo',
    'numdoc',
	];

     protected $guarded =[
     
    ];
}
