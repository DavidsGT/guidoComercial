<?php

namespace comercial\Http\Controllers;

use Illuminate\Http\Request;

use comercial\Http\Requests;
use Illuminate\Support\Facades\Input;
//use comercial\http\Requests\DevolucionRequest;
use Illuminate\Support\Facades\Redirect;
use comercial\Devolucion;
use DB;

//para controlar fecha/hora
use Carbon\Carbon;
use Response;
use Illuminate\Support\Collection;

class DeventasControl extends Controller
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
    			$ingreso=DB::table('venta as i')
    			->join('persona as p','i.idcliente','=','p.idpersona')
    			->join('detalle_venta as di','di.idventa','=','i.idventa')
    			->select('i.idventa','i.fecha_hora','p.nombre','i.tipo_comprobante','i.serie_comprobante','i.numero_comprobante','i.impuesto','i.estado',DB::raw('(i.total_venta) as total'),DB::raw('sum(di.cantidad) as cantidad'))
    			->where('i.numero_comprobante','LIKE','%'.$query.'%')
    			->orwhere('i.fecha_hora','LIKE','%'.$query.'%')
    			->orderBy('i.idventa','desc')
				->groupBy('i.idventa','i.fecha_hora','p.nombre','i.tipo_comprobante','i.serie_comprobante','i.numero_comprobante','i.impuesto','i.estado')
				->paginate(7);


				return view('ventas.devoluciones.index',["ingresos"=>$ingreso,"searchText"=>$query]);
    		}
    }
    

    public function create($ing)
    {
       	$cuenta = DB::table('entidades as ent')
        ->select(DB::raw('CONCAT(ent.tipo," No.: ",ent.numero," ",ent.nombre) as cuentas'), 'ent.identidad')
        ->where('ent.estado','=','Activa')
        ->get();

        $orden = DB::table('venta as i')
                ->join('persona as p','i.idcliente','=','p.idpersona')
                ->join('detalle_venta as di','di.idventa','=','i.idventa')
                ->select('i.idventa','i.fecha_hora','p.nombre',DB::raw('CONCAT(i.tipo_comprobante,": ",i.serie_comprobante,"-",i.idventa) as comprobante'),'i.impuesto','i.estado','i.total_venta as total')
                ->where('i.idventa','=',$ing)
                ->first();

         $detallecp = DB::table('devolucion as d')
        ->where('d.idingreso','=',$ing)
        ->get();

        $ingreso = DB::table('venta as i')
                ->join('persona as p','i.idcliente','=','p.idpersona')
                ->join('detalle_venta as di','di.idventa','=','i.idventa')
                ->select('i.idventa','i.fecha_hora','p.nombre','i.tipo_comprobante','i.serie_comprobante','i.idventa',DB::raw('(i.total_venta) as subtotal'),'i.impuesto','i.estado',DB::raw('sum(di.precio_venta*di.cantidad) as total'))
                ->where('i.idventa','=',$ing)
                ->first();
        
        $detalle = DB::table('detalle_venta as d')
        ->join('articulo as a','d.idarticulo','=','a.idarticulo')
        ->select('a.idarticulo','a.nombre as articulo','d.cantidad','d.precio_venta','d.tipoiva')
        ->where('d.idventa','=',$ing)
        ->get();

        return view('ventas.devoluciones.create',['cuentas'=>$cuenta,'ordenes'=>$orden,'detallecp'=>$detallecp,'ingreso'=>$ingreso,'detalles'=>$detalle]);
    }

//alamcenar en la base
    public function store(Request $request)
    {
     try{
       DB::beginTransaction();
           $ingreso=new Devolucion;
          // $ingreso->$valor1 = $request->get("ing");
           $ingreso->iddetorden=$request->get('iddetorden');
           $ingreso->idingreso=$request->get('idingreso');
           $ingreso->fechacredito=$request->get('fechacredito');
           $ingreso->comprobante=$request->get('comprobante');
           $ingreso->proveedor=$request->get('proveedor');
           $ingreso->valdeuda=$request->get('cantcompra');
           $ingreso->cantidad=$request->get('cantidad');
           $ingreso->articulo=$request->get('artiselect');
           $ingreso->motivo=$request->get('motivo');
           $mytime = Carbon::now('America/guayaquil');
           $ingreso->fechadevol=$mytime->toDateTimeString();
           $ingreso->numdoc=$request->get('numdoc');
           $ingreso->estado='ABIERTA';
            $ingreso->tipo='VENTA';

        //   $ingreso->vendedor=$request->get('vendedor');
        //   $ingreso->formapago=$request->get('formapago');
           
           $ingreso->save();

     //      $idarticulo = $request->get('idarticulo');
      //     $cantidad = $request->get('cantidad');
      //     $precio_compra = $request->get('precio_compra');
      //     $precio_venta = $request->get('precio_venta');
      //     $tipoiva = $request->get('iva');

           //$cont = 0;

          DB::commit();

     }catch(\Exception $e)
      {
      DB::rollback();
     }

      //  return Redirect::to('contabilidad/ordencp');
     return Redirect::back();

    }

     public function show($ing)
    {
        $plan = DB::table('plancuenta as plan')
        ->select(DB::raw('CONCAT(plan.codigo," - ",plan.detalle) as cuentas'))
       // ->where('ent.estado','=','Activa')
        ->get();

       $detalle = DB::table('detalle_ingreso as d')
        ->join('articulo as a','d.idarticulo','=','a.idarticulo')
        ->select('a.nombre as articulo','d.cantidad','d.precio_compra','d.precio_venta','d.tipoiva')
        ->where('d.idingreso','=',$ing)
        ->get();

       $compegre = DB::table('devolucion as dc')
        ->where('dc.iddetorden','=',$ing)
         ->first();

        return view('ventas.devoluciones.show',['compegres'=>$compegre,'cuentas'=>$plan,'detart'=>$detalle]);
    }

    Public function destroy($id)
    {
        $ingreso=Devolucion::findOrFail($id);
        $ingreso->estado='C';
        $ingreso->update();
        return Redirect::to('ventas/devoluciones');
    }
}
