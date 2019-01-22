<?php

namespace comercial;

use Illuminate\Database\Eloquent\Model;

class Perfil extends Model
{
      protected $table='perfil';
    protected $primaryKey='idperfil';

    public $timestamps=false;

    protected $fillable = [
    'detalle',
    'descripcion',
    'estado'
    ];

}
