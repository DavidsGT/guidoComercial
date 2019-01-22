<?php

namespace comercial;

use Illuminate\Database\Eloquent\Model;

class Inventario extends Model
{
    protected $table='articulo';
    protected $primaryKey='idarticulo';

    public $timestamps=false;

    protected $fillable = [
    'idcategoria',
    'codigo',
    'nombre',
    'stock',
    'stockmin',
    'descripcion',
    'imagen',
    'estado',
    'iva',
    ];
}
