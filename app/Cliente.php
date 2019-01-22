<?php

namespace comercial;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
     // MODELO PARA AFECTAR TABLA CLIENTE
    protected $table='cliente';
    protected $primaryKey='id';

    public $timestamps=false;

    protected $fillable = [
    'fk_pg_tipo_documento',
    'fk_pg_tipo_cliente',
    'nombre',
    'apellido',
    'numero_documento',
    'direccion',
    'telefono',
    'email',
    'cliente_desde',
    'fecha_nacimiento',
    'estado'
    ];
}
