<?php

namespace comercial;

use Illuminate\Database\Eloquent\Model;

class Ingreso extends Model
{
    //
    protected $table='ingreso';
    protected $primaryKey='idingreso';

    public $timestamps=false;

    protected $fillable = [
    'idproveedor',
    'idempleado',
    'fk_pg_tipo_comprobante',
    'fk_pg_forma_pago',
    'serie_comprobante',
	'numero_comprobante',
	'fecha_hora',
    'subtotal',
    'impuesto',
    'retfuente',
    'retiva',
    'estado',
    ];
    public function detalles(){
        return $this->hasMany('comercial\DetalleIngreso','idingreso');
    }
    public function empleadoEncargado(){
        return $this->belongsTo('comercial\Empleado');
    }
    public function proveedorEncargado(){
        return $this->belongsTo('comercial\Proveedor');
    }
}
