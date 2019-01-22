<?php

namespace comercial\Http\Controllers;

use Illuminate\Http\Request;

use comercial\Http\Requests;
use Illuminate\Support\Facades\Input;
use comercial\http\Requests\InventarioRequest;
use Illuminate\Support\Facades\Redirect;
use comercial\Inventario;
use DB;

class InventarioControl extends Controller
{
  	 public function __construct()
    {
        $this->middleware('auth');

    }

   public function index(Request $request)
    {

    		if ($request)
    		{
    			$query=trim($request->get('searchText'));
    			$articulos=DB::table('articulo as a')
    			->join('categoria as c','a.idcategoria','=','c.idcategoria')
    		->select('a.idarticulo','a.nombre','a.codigo','a.stock','c.nombre as categoria','a.descripcion','a.imagen','a.estado','a.iva')
    			->where('a.nombre','LIKE','%'.$query.'%')
                ->where('a.estado','=','Activo')
                ->orwhere('a.codigo','LIKE','%'.$query.'%')
    			->where('a.estado','=','Activo')
                ->orwhere('c.nombre','LIKE','%'.$query.'%')
                ->orderBy('a.idarticulo','desc')
    			->paginate(7);

    			return view('contabilidad.inventario.index',["articulo"=>$articulos,"searchText"=>$query]);

    		}
    }

     public function show($id)
    {
	        		$articulo = DB::table('articulo as a')
	        		 ->where('a.idarticulo','=',$id) 
	        		 ->first();

	        		$ingreso = DB::table('articulo as a')
	                ->join('detalle_ingreso as d','d.idarticulo','=','a.idarticulo')
	                ->join('ingreso as i','i.idingreso','=','d.idingreso')
	                ->join('persona as p','p.idpersona','=','i.idproveedor')
	                ->select('a.nombre as articulo','i.idingreso','i.fecha_hora','i.numero_comprobante','p.nombre','d.cantidad','d.precio_compra as precio',DB::raw('(d.precio_compra * d.cantidad) as subtot'), DB::raw('"INGRESO" as detalle'))
	                ->where('a.idarticulo','=',$id);

	                $ingreso1 = DB::table('articulo as a')
	                ->join('detalle_venta as dV','dV.idarticulo','=','a.idarticulo')
	                ->join('venta as v','v.idventa','=','dv.iddetalle_venta')
	                ->select('a.nombre as articulo','v.idventa as idingreso','v.fecha_hora','v.numero_comprobante',DB::raw('"Venta a Cliente" as nombre'),DB::raw('(dv.cantidad * -1) as cantidad'),'dv.precio_venta as precio',DB::raw('(dv.precio_venta * dv.cantidad) as subtot'), DB::raw('"EGRESO" as detalle'))
	                ->where('a.idarticulo','=',$id)
                	->union($ingreso)
                	->get();
        
         return view('contabilidad.inventario.show',['ingreso'=>$ingreso1,'art'=>$articulo]);
    }
}
