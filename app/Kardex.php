<?php

namespace comercial;

use Illuminate\Database\Eloquent\Model;

class Kardex extends Model
{
    protected $table='kardex';
    protected $primaryKey='id_kardex';

    public $timestamps=false;

    protected $fillable = [
    'id_articulo',
    'fecha',
    'tipo',
    'detalle',
    'precio_unitario',
    'precio_total',
    'cantidad',
    ];
}
