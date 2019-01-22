<?php

namespace comercial\Http\Controllers;

use Illuminate\Http\Request;

use comercial\Http\Requests;
use Illuminate\Support\Facades\Input;
use comercial\http\Requests\VentasFormRequest;
use Illuminate\Support\Facades\Redirect;
use comercial\Ventas;
use comercial\VentasDet;
use comercial\DetalleVentas;
use DB;
use Illuminate\Pagination\LengthAwarePaginator;
//para controlar fecha/hora
use Carbon\Carbon;
use Response;
use Illuminate\Support\Collection;

class VentasController extends Controller
{
     public function __construct()
    {
        $this->middleware('auth', ['except' => ['codigovendedor']]);

    }
    public function codigovendedor(Request $request, $cod)
    {
        if($request->ajax()){
            $vendedor = DB::table('empleado as e')
            ->select('e.nombre','e.id')
            ->where('e.codigo','=',$cod)
            ->where('e.estado','=',1)
            ->get();
            return response()->json($vendedor);
        }
    }
    public function index(Request $request)
    {
		if ($request)
		{
			$query=trim($request->get('searchText'));
            $ventas=DB::select('select * from vw_consulta_ventas where numero_comprobante like "%'.$query.'%"');
            $ventas = $this->arrayPaginator($ventas, $request);
			return view('ventas.venta.index',["ventas"=>$ventas,"searchText"=>$query]);
		}
    }
    public function arrayPaginator($array, $request)
    {
        $page = Input::get('page', 1);
        $perPage = 7;
        $offset = ($page * $perPage) - $perPage;

        return new LengthAwarePaginator(array_slice($array, $offset, $perPage, true), count($array), $perPage, $page,['path' => $request->url(), 'query' => $request->query()]);
    }

    public function create()
    {
    	$personas=DB::table('cliente as per')
        ->select(DB::raw('CONCAT(per.numero_documento," ",per.nombre) as nombre'),'per.id','per.fk_pg_tipo_cliente','pg.descripcion')
        ->join('pg_detalle as pg','pg.id','=','per.fk_pg_tipo_cliente')
        ->where('pg.id_tabla','=','3')
        ->get();

    	$articulos = DB::table('articulo as art')
    	->join('detalle_ingreso as di','art.idarticulo','=','di.idarticulo')
        ->select(DB::raw('CONCAT(art.codigo," ",art.nombre) as articulo'), 'art.idarticulo','art.stock','di.precio_venta_normal as precio_normal','di.precio_venta_empresarial as precio_empresarial','di.precio_venta_distribucion as precio_distribucion','art.iva','art.stockmin')
        ->where('art.estado','=','Activo')
        ->where('art.stock','>','0')
        ->where('di.precio_venta_normal','>','0')
        ->groupBy('articulo','art.idarticulo','art.stock')
        ->get();

        return view('ventas.venta.create',['personas'=>$personas,'articulos'=>$articulos]);
    }

//alamcenar en la base
    public function store(VentasFormRequest $request)
    {
      try{
        DB::beginTransaction();
        $venta=new Ventas;
        $venta->idcliente=$request->get('idcliente');
        $venta->idvendedor=$request->get('idvendedor');
        $venta->tipo_comprobante=$request->get('tipo_comprobante');
        $venta->serie_comprobante=$request->get('serie_comprobante');
        $venta->numero_comprobante=$request->get('numero_comprobante');
        $venta->total_venta=$request->get('subtotal');
        $mytime = Carbon::now('America/guayaquil');
        $venta->fecha_hora=$mytime->toDateTimeString();
        $venta->impuesto=$request->get('tot_iva12');
        $venta->estado='Proforma';
        $venta->save();
        
        $idarticulo = $request->get('idarticulo');
        $cantidad = $request->get('cantidad');
        $descuento = $request->get('descuento');
        $precio_venta = $request->get('precio_venta');
        $iva = $request->get('iva');
        $cont = 0;

        while($cont < count($idarticulo)){
          $detalle = new DetalleVentas();
          $detalle->idventa= $venta->idventa; 
          $detalle->idarticulo= $idarticulo[$cont];
          $detalle->cantidad= $cantidad[$cont];
          $detalle->descuento= $descuento[$cont];
          $detalle->precio_venta= $precio_venta[$cont];
          $detalle->tipoiva= $iva[$cont];
          $detalle->save();
          $cont++;            
       }
        DB::commit();
      }catch(\Exception $e){
        DB::rollback();
      }
      return Redirect::to('ventas/venta');
    }

    public function show($id)
    
    {
        $venta = DB::table('venta as v')
                ->join('persona as p','v.idcliente','=','p.idpersona')
                ->join('detalle_venta as dv','dv.idventa','=','v.idventa')
                ->select('v.idventa','v.fecha_hora','p.nombre','v.tipo_comprobante','v.serie_comprobante','v.numero_comprobante','v.impuesto','v.estado','v.total_venta','v.idvendedor')
                ->where('v.idventa','=',$id)
                ->first();
        
        $detalle = DB::table('detalle_venta as d')
        ->join('articulo as a','d.idarticulo','=','a.idarticulo')
        ->select('a.nombre as articulo','d.cantidad','d.descuento','d.precio_venta','d.iddetalle_venta','d.tipoiva')
        ->where('d.idventa','=',$id)
        ->where('d.estado','=',null)
        ->get();

          $articulos = DB::table('articulo as art')
      ->join('detalle_ingreso as di','art.idarticulo','=','di.idarticulo')
        ->select(DB::raw('CONCAT(art.codigo," ",art.nombre) as articulo'), 'art.idarticulo','art.stock',DB::raw('avg(di.precio_venta_normal) as precio_promedio'),'art.iva')
        ->where('art.estado','=','Activo')
        ->where('art.stock','>','0')
         ->where('di.precio_venta','>','0')
        ->groupBy('articulo','art.idarticulo','art.stock','art.iva')
        ->get();

        return view('ventas.venta.show',['venta'=>$venta,'detalles'=>$detalle,'articulos'=>$articulos]);
    }

    
    public function destroy($id)
    {
        $venta=Ventas::findOrFail($id);
        $venta->estado='Anulado';
        $venta->update();
        return Redirect::to('ventas/venta');
    }


 public function update($id)
    {
        $venta=VentasDet::findOrFail($id);
        $venta->estado='A';
        $venta->update();
    return Redirect::back();

    }

}
