<?php

namespace comercial\Http\Controllers;

use Illuminate\Http\Request;

use comercial\Http\Requests;
use Illuminate\Support\Facades\Input;
use comercial\http\Requests\FacturaFormRequest;
use Illuminate\Support\Facades\Redirect;
use comercial\Factura;
use comercial\VentasDet;
use comercial\DetalleVentas;
use comercial\Caja;
use DB;

//para controlar fecha/hora
use Carbon\Carbon;
use Response;
use Illuminate\Support\Collection;

class FacturaController extends Controller
{
    //
     public function __construct()
    {
        $this->middleware('auth');

    }

    public function index(Request $request)
    {
        $cajaanterior = DB::table('acaja as a')
              ->select('a.fechaap')
              ->where('a.estado','=',1)
              ->orderBy('a.fechaap','desc')
              ->first();
        if ($request){
          $query=trim($request->get('searchText'));
          $ventas=DB::table('venta as v')
          ->join('persona as p','v.idcliente','=','p.idpersona')
          ->join('detalle_venta as dv','dv.idventa','=','v.idventa')
          ->select('v.idventa','v.fecha_hora','p.nombre','v.tipo_comprobante','v.serie_comprobante','v.numero_comprobante','v.impuesto','v.estado','v.total_venta')
          ->where('v.idventa','LIKE','%'.$query.'%')
          ->whereDate('v.fecha_hora', '>', $cajaanterior->fechaap)
          ->orderBy('v.idventa','desc')
        ->groupBy('v.idventa','v.fecha_hora','p.nombre','v.tipo_comprobante','v.serie_comprobante','v.numero_comprobante','v.impuesto','v.estado')
        ->paginate(7);

        return view('ventas.factura.index',["ventas"=>$ventas,"searchText"=>$query]);
        }
        //echo "Mayor 1";
    }

    public function create()
    {
    	$personas=DB::table('persona')->where('tipo_persona','=','Cliente')->get();

    	$articulos = DB::table('articulo as art')
    	->join('detalle_ingreso as di','art.idarticulo','=','di.idarticulo')
        ->select(DB::raw('CONCAT(art.codigo," ",art.nombre) as articulo'), 'art.idarticulo','art.stock','di.precio_venta_normal as precio_promedio','art.iva')
        ->where('art.estado','=','Activo')
        ->where('art.stock','>','0')
        ->where('di.precio_venta_normal','>','0')
        ->groupBy('articulo','art.idarticulo','art.stock')
        ->get();

        return view('ventas.factura.create',['personas'=>$personas,'articulos'=>$articulos]);
    }

//alamcenar en la base
    public function store(FacturaFormRequest $request)
    {
     

    try{
     DB::beginTransaction();
          $venta=new Factura;
          $venta->idcliente=$request->get('idcliente');
          $venta->idvendedor=$request->get('idvendedor');
           $venta->tipo_comprobante=$request->get('tipo_comprobante');
           $venta->serie_comprobante=$request->get('serie_comprobante');
           $venta->numero_comprobante=$request->get('numero_comprobante');
           $venta->total_venta=$request->get('subtotal');
           
           $mytime = Carbon::now('America/guayaquil');
           $venta->fecha_hora=$mytime->toDateTimeString();
           $venta->impuesto=$request->get('tot_iva12');
           $venta->estado='A';
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
                 $cont=$cont+1;                  
               }
         DB::commit();

  }catch(\Exception $e)
     {
     DB::rollback();
     }

        return Redirect::to('ventas/factura');

    }

     public function show($id)
    {
        $venta = DB::table('venta as v')
                ->join('persona as p','v.idcliente','=','p.idpersona')
                ->join('detalle_venta as dv','dv.idventa','=','v.idventa')
                ->select('v.idventa','v.fecha_hora','p.nombre','p.direccion','p.telefono','v.tipo_comprobante','v.serie_comprobante','v.numero_comprobante','v.impuesto','v.estado','v.total_venta','v.idvendedor')
                ->where('v.idventa','=',$id)
                ->first();
        
        $detalle = DB::table('detalle_venta as d')
        ->join('articulo as a','d.idarticulo','=','a.idarticulo')
        ->select('a.nombre as articulo','a.codigo','d.cantidad','d.descuento','d.precio_venta','d.iddetalle_venta','d.tipoiva')
        ->where('d.idventa','=',$id)
       ->where('d.estado','=',null)
        ->get();

          $articulos = DB::table('articulo as art')
      ->join('detalle_ingreso as di','art.idarticulo','=','di.idarticulo')
        ->select(DB::raw('CONCAT(art.codigo," ",art.nombre) as articulo'), 'art.idarticulo','art.stock',DB::raw('avg(di.precio_venta_normal) as precio_promedio'),'art.iva')
        ->where('art.estado','=','Activo')
        ->where('art.stock','>','0')
        ->groupBy('articulo','art.idarticulo','art.stock','art.iva')
        ->get();

        return view('ventas.factura.show',['venta'=>$venta,'detalles'=>$detalle,'articulos'=>$articulos]);
    }
    Public function destroy(FacturaFormRequest $request,$id)
    {
        $venta=Factura::findOrFail($id);
        $venta->valorpago=$request->get('valreca');
        $venta->estado='Facturado';
        $venta->update();
      //  return Redirect::to('ventas/factura');
        return Redirect::back();
    }


 Public function update($id)
    {
        $venta=Factura::findOrFail($id);
        $venta->estado='C';
        $venta->update();
    return Redirect::to('ventas/factura');

    }

}
