<?php

namespace comercial;

use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    //MODELO PARA AFECTAR LA TABLA PROVEEDOR
    protected $table='proveedor';
    protected $primaryKey='id';

    public $timestamps=false;

    protected $fillable = [
    'id',
    'fk_pg_tipo_documento',
    'nombre',
    'apellido',
    'numero_documento',
    'direccion',
    'telefono',
    'email',
    'fk_pg_tipo_doc_rep',
    'num_doc_rep',
    'nom_completo_rep',
    'email_rep',
    'telefono_rep',
    'estado'
    ];
}