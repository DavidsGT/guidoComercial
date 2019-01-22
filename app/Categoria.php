<?php

namespace comercial;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    // MODELO PARA AFECTAR TABLA CATEGORIA

    protected $table='categoria';
    protected $primaryKey='idcategoria';

    public $timestamps=false;

    protected $fillable = [
    'nombre',
    'descripcion',
    'condicion'
    ];

}
