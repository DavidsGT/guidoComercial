<?php

namespace comercial;

use Illuminate\Database\Eloquent\Model;

class Bancos extends Model
{
    //
     protected $table='entidades';
    protected $primaryKey='identidad';

    public $timestamps=false;

    protected $fillable = [
    'codigo',
    'tipo',
    'numero',
    'nombre',
    'estado',
    ];

}
