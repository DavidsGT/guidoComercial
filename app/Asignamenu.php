<?php

namespace comercial;

use Illuminate\Database\Eloquent\Model;

class Asignamenu extends Model
{
     protected $table='menu';
    protected $primaryKey='idmenu';

    public $timestamps=false;

    protected $fillable = [
   'idpadre',
   'detpadre',
   'dethijo',
   'link',
   'idhijo',
   'usuario',
  ];
}
