<?php
namespace comercial;

use Illuminate\Database\Eloquent\Model;

class Contribuyente extends Model
{
    protected $table='contribuyente';
    protected $primaryKey='id';

    public $timestamps=false;

    protected $fillable = [
    'ruc',
    'razon_social',
    'cod_establecimiento',
    'cod_emision',
    'direccion_matriz',
    'telefono',
    'email',
    'fk_pg_tipo_doc_representante',
    'numero_documento',
    'ruc_contador',
    'lleva_contabilidad',
    'fk_pg_tipo_emision',
    'tiempo_max_espera',
    'fk_pg_tipo_ambiente',
    'estado'
    ];
}