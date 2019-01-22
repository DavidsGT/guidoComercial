<?php

namespace comercial;

use Illuminate\Database\Eloquent\Model;

class PgDetalle extends Model
{
    // MODELO PARA INTERACTUAR CON LOS CAMPOS DE LA TABLAS CREADAS DENTRO SON
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
    protected $table='pg_detalle';
    protected $primaryKey='id';

    public $timestamps=false;

    protected $fillable = [
    'id_tabla',
    'descripcion',
    'estado'
    ];
    public function pgCabecera(){
        return $this->belongsTo('comercial\PgCabecera');
    }
}