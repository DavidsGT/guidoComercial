<?php

namespace comercial;

use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
     // MODELO PARA AFECTAR TABLA CLIENTE
    protected $table='empleado';
    protected $primaryKey='id';

    public $timestamps=false;

    protected $fillable = [
    'fk_pg_cargo',
    'fk_pg_tipo_doc',
    'codigo',
    'nombre',
    'apellido',
    'numero_documento',
    'direccion',
    'telefono',
    'email',
    'empleado_desde',
    'fecha_nacimiento',
    'estado'
    ];
}