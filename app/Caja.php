<?php

namespace comercial;

use Illuminate\Database\Eloquent\Model;

class Caja extends Model
{
    protected $table='acaja';
    protected $primaryKey='idacaja';

    public $timestamps=false;

    protected $fillable = [
    'fechaap',
    'fechacie',
    'usuario',
    'valorini',
    'valorfin',
    'novedad',
    'estado',
    ];
}
