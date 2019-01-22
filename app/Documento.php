<?php

namespace comercial;

use Illuminate\Database\Eloquent\Model;

class Documento extends Model
{
    protected $table='documentos';
    protected $primaryKey='iddocumento';

    public $timestamps=false;

    protected $fillable = [
      'fecha',
      'codigo',
      'cuenta',
      'debito',
      'credito',
      'concepto',
      'numerodoc',
      'proveedor',
      'formapago',
      'estado',
    ];

     protected $guarded =[
     
    ];
}
