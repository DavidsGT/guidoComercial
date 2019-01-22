<?php

namespace comercial;

use Illuminate\Database\Eloquent\Model;

class PgCabecera extends Model
{
    // MODELO PARA INTERACTUAR CON TABLAS CON CAMPOS SIMILARES LAS TABLAS CREADAS DENTRO SON
    /**
     * CARGO
     * TIPO_DOCUMENTO
     * TIPO_CLIENTE
     * TIPO_EMISION
     * TIPO_AMBIENTE
     * TIPO_PRODUCTO
     * CATEGORIA_PRODUCTO
     * TIPO_COMPROBANTE
     * FORMA_PAGO
    */
    protected $table='pg_cabecera';
    protected $primaryKey='id';

    public $timestamps=false;

    protected $fillable = [
        'tabla',
        'estado'
    ];
    public function pgDetalles(){
    	return $this->hasMany('comercial\PgDetalle','id_tabla');
    }
}