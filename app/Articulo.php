<?php

namespace comercial;

use Illuminate\Database\Eloquent\Model;

class Articulo extends Model
{
    //
    protected $table='articulo';
    protected $primaryKey='idarticulo';
    public $timestamps=false;
    protected $fillable = [
    'fk_pg_categoria',
    'codigo',
    'nombre',
    'descipcion',
    'precio_unitario',
    'precio_empresarial',
    'precio_distribucion',
    'fk_pg_tipo_producto',
    'stock',
    'stockmin',
    'imagen',
    'iva',
    'estado'
    ];
}
