<?php

namespace comercial;

use Illuminate\Database\Eloquent\Model;

class Ordencp extends Model
{
    //
protected $table='detordencp';
    protected $primaryKey='iddetorden';

    public $timestamps=false;

    protected $fillable = [
    'iddetorden',
    'idingreso',
    'fechacredito',
    'proveedor',
    'valdeuda',
    'valpagado',
    'entidad',
    'numdoc',
	];

     protected $guarded =[
     
    ];
}
