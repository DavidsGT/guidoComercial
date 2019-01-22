<?php

namespace comercial;

use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
     // MODELO PARA AFECTAR TABLA CATEGORIA

    protected $table='persona';
    protected $primaryKey='idpersona';

    public $timestamps=false;

    protected $fillable = [
    'tipo_persona',
    'nombre',
    'tipo_documento',
    'numero_documento',
    'direccion',
    'telefono',
    'email',
    'cedularepresenta',
    'representante',
    'emailrepresenta',
    'telefonorepresenta',
    ];

    protected $guarded =[
    ];
}
