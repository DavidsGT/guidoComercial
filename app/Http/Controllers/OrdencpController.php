<?php

namespace comercial\Http\Controllers;

use Illuminate\Http\Request;

use comercial\Http\Requests;
use Illuminate\Support\Facades\Input;
use comercial\http\Requests\OrdencpFormRequest;
use Illuminate\Support\Facades\Redirect;
use comercial\Ordencp;
use DB;

//para controlar fecha/hora
use Carbon\Carbon;
use Response;
use Illuminate\Support\Collection;



class OrdencpController extends Controller
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
    			$ingreso=DB::table('ingreso as i')
    			->join('persona as p','i.idproveedor','=','p.idpersona')
    			->join('detalle_ingreso as di','di.idingreso','=','i.idingreso')
    			->select('i.idingreso','i.fecha_hora','p.nombre','i.tipo_comprobante','i.serie_comprobante','i.numero_comprobante','i.impuesto','i.estado',DB::raw('(i.subtotal+i.impuesto) as total'),'i.formapago')
    			->where('i.numero_comprobante','LIKE','%'.$query.'%')
    			//->where('i.formapago','!=','Efectivo')
    			->orderBy('i.idingreso','desc')
				->groupBy('i.idingreso','i.fecha_hora','p.nombre','i.tipo_comprobante','i.serie_comprobante','i.numero_comprobante','i.impuesto','i.estado')
				->paginate(7);


				return view('contabilidad.ordencp.index',["ingresos"=>$ingreso,"searchText"=>$query]);
    		}
    }
    

    public function create($ing)
    {
       	$cuenta = DB::table('entidades as ent')
        ->select(DB::raw('CONCAT(ent.tipo," No.: ",ent.numero," ",ent.nombre) as cuentas'), 'ent.identidad')
        ->where('ent.estado','=','Activa')
        ->get();

        $orden = DB::table('ingreso as i')
                ->join('persona as p','i.idproveedor','=','p.idpersona')
                ->join('detalle_ingreso as di','di.idingreso','=','i.idingreso')
                ->select('i.idingreso','i.fecha_hora','p.nombre',DB::raw('CONCAT(i.tipo_comprobante,": ",i.serie_comprobante,"-",i.numero_comprobante) as comprobante'),'i.impuesto','i.estado',DB::raw('(i.subtotal+i.impuesto) as total'),'i.formapago')
                ->where('i.idingreso','=',$ing)
                ->first();

         $detallecp = DB::table('detordencp as d')
        ->where('d.idingreso','=',$ing)
        ->get();

        $ingreso = DB::table('ingreso as i')
                ->join('persona as p','i.idproveedor','=','p.idpersona')
                ->join('detalle_ingreso as di','di.idingreso','=','i.idingreso')
                ->select('i.idingreso','i.fecha_hora','p.nombre','i.tipo_comprobante','i.serie_comprobante','i.numero_comprobante','i.retfuente',DB::raw('(i.subtotal+i.impuesto) as subtotal'),'i.impuesto','i.retiva','i.estado',DB::raw('sum(di.precio_compra*di.cantidad) as total'),'i.formapago')
                ->where('i.idingreso','=',$ing)
                ->first();
        
        $detalle = DB::table('detalle_ingreso as d')
        ->join('articulo as a','d.idarticulo','=','a.idarticulo')
        ->select('a.nombre as articulo','d.cantidad','d.precio_compra','d.precio_venta','d.tipoiva')
        ->where('d.idingreso','=',$ing)
        ->get();

        return view('contabilidad.ordencp.create',['cuentas'=>$cuenta,'ordenes'=>$orden,'detallecp'=>$detallecp,'ingreso'=>$ingreso,'detalles'=>$detalle]);
    }

//alamcenar en la base
    public function store(OrdencpFormRequest $request)
    {
     try{
       DB::beginTransaction();
           $ingreso=new Ordencp;
          // $ingreso->$valor1 = $request->get("ing");
           $ingreso->iddetorden=$request->get('iddetorden');
           $ingreso->idingreso=$request->get('idingreso');
           $ingreso->fechacredito=$request->get('fechacredito');
           $ingreso->comprobante=$request->get('comprobante');
           $ingreso->proveedor=$request->get('proveedor');
           $ingreso->valdeuda=$request->get('valdeuda');
           $ingreso->valpagado=$request->get('valpagado');
           $ingreso->entidad=$request->get('entidad');
           $ingreso->tipopago=$request->get('tipopago');
           $mytime = Carbon::now('America/guayaquil');
           $ingreso->fechapago=$mytime->toDateTimeString();
           $ingreso->numdoc=$request->get('numdoc');
           $ingreso->estado='ABIERTA';

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

       $compegre = DB::table('detordencp as dc')
        ->where('dc.iddetorden','=',$ing)
         ->first();

        return view('contabilidad.ordencp.show',['compegres'=>$compegre,'cuentas'=>$plan]);
    }

    Public function destroy($id)
    {
        $ingreso=Ingreso::findOrFail($id);
        $ingreso->estado='C';
        $ingreso->update();
        return Redirect::to('contabilidad/ordencp');
    }
}
