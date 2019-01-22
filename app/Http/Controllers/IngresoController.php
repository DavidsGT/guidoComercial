<?php

namespace comercial\Http\Controllers;

use Illuminate\Http\Request;

use comercial\Http\Requests;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use comercial\Ingreso;
use comercial\Kardex;
use comercial\Proveedor;
use comercial\Articulo;
use comercial\PgCabecera;
use comercial\DetalleIngreso;
use DB;

use Carbon\Carbon;
use Response;
use Illuminate\Support\Collection;

class IngresoController extends Controller{
    public function __construct(){
    $this->middleware('auth');
    }

    public function index(Request $request){
        if ($request){
        echo "Buenas tardes";
        $query=trim($request->get('searchText'));
        $ingresos = Ingreso::where('numero_comprobante','LIKE','%'.$query.'%')
        ->orderBy('idingreso')
        ->groupBy('idingreso','fecha_hora','fk_pg_tipo_comprobante','serie_comprobante','numero_comprobante','impuesto')
        ->paginate(7);
        return view('compras.ingreso.index',["ingresos"=>$ingresos,"searchText"=>$query]);
        }
    }

    public function create(){
        $proveedor = Proveedor::where('estado',true)->get();
        $articulos = Articulo::select(DB::raw('CONCAT(codigo," ",nombre) as articulo'), 'idarticulo')
                    ->where('estado',true)
                    ->get();
        return view('compras.ingreso.create',['personas'=>$proveedor,'articulos'=>$articulos,"formaPago"=>PgCabecera::find(9)->pgDetalles,"tipoComprobante"=>PgCabecera::find(8)->pgDetalles,"tipodocumentos"=>PgCabecera::find(2)->pgDetalles]);
    }

    public function store(Request $request){
        /*try{*/
            DB::beginTransaction();
            $ingreso=new Ingreso;
            $ingreso->idproveedor=$request->get('idproveedor');
            $ingreso->fk_pg_tipo_comprobante=$request->get('tipo_comprobante');
            $ingreso->serie_comprobante=$request->get('serie_comprobante');
            $ingreso->numero_comprobante=$request->get('numero_comprobante');
            $mytime = Carbon::now('America/guayaquil');
            $ingreso->fecha_hora=$mytime->toDateTimeString();
            $ingreso->impuesto=$request->get('total_iva');
            $ingreso->subtotal=$request->get('subtot1');
            $ingreso->idempleado=$request->get('idvendedor');
            $ingreso->fk_pg_forma_pago=$request->get('formapago');
            $ingreso->retfuente=$request->get('pretfuente');
            $ingreso->retiva=$request->get('pretiva');     
            $ingreso->save();
            $proveedor=Proveedor::findOrFail($ingreso->idproveedor);
            $idarticulo = $request->get('idarticulo');
            $cantidad = $request->get('cantidad');
            $precio_compra = $request->get('precio_compra');
            $precio_venta_normal = $request->get('precio_venta_normal');
            $precio_venta_empresarial = $request->get('precio_venta_empresarial');
            $precio_venta_distribucion = $request->get('precio_venta_distribucion');
            $tipoiva = $request->get('iva');
            $cont = 0;
            while($cont < count($idarticulo)){
            $detalle = new DetalleIngreso();
            $detalle->idingreso= $ingreso->idingreso; 
            $detalle->idarticulo= $idarticulo[$cont];
            $detalle->cantidad= $cantidad[$cont];
            $detalle->precio_compra= $precio_compra[$cont];
            $detalle->precio_venta_normal= $precio_venta_normal[$cont];
            $detalle->precio_venta_empresarial= $precio_venta_empresarial[$cont];
            $detalle->precio_venta_distribucion= $precio_venta_distribucion[$cont];
            $detalle->iva=(isset($tipoiva[$cont])?true:false);
            $detalle->save();
            $kardex = new Kardex();
            $kardex->id_articulo = $idarticulo[$cont];
            $kardex->fecha = $mytime->toDateTimeString();
            $kardex->detalle = 'Compra a Proveedor: '.$proveedor->nombre;
            $kardex->cantidad = $cantidad[$cont];
            $kardex->precio_unitario = $precio_compra[$cont];
            $kardex->precio_total = $precio_compra[$cont] * $cantidad[$cont];
            $kardex->tipo = 'I';
            $kardex->save();
            $cont=$cont+1;              
            }
            DB::commit();
        /*}catch(\Exception $e){
            DB::rollback();
        }*/
        return Redirect::to('compras/ingreso');
    }

    public function show($id){
        $ingreso = DB::table('ingreso as i')
                    ->join('persona as p','i.idproveedor','=','p.idpersona')
                    ->join('detalle_ingreso as di','di.idingreso','=','i.idingreso')
                    ->select('i.idingreso','i.fecha_hora','p.nombre','i.tipo_comprobante','i.serie_comprobante','i.numero_comprobante','i.impuesto','i.estado','i.retfuente','i.subtotal','i.retiva','i.impuesto',DB::raw('sum(di.precio_compra*di.cantidad) as total'))
                    ->where('i.idingreso','=',$id)
                    ->first();
        $detalle = DB::table('detalle_ingreso as d')
                    ->join('articulo as a','d.idarticulo','=','a.idarticulo')
                    ->select('a.nombre as articulo','d.cantidad','d.precio_compra','d.precio_venta_normal','d.tipoiva')
                    ->where('d.idingreso','=',$id)
                    ->get();
        return view('compras.ingreso.show',['ingreso'=>$ingreso,'detalles'=>$detalle]);
    }

    Public function destroy($id){
        $ingreso=Ingreso::findOrFail($id);
        $ingreso->estado=false;
        $ingreso->update();
        return Redirect::to('compras/ingreso');
    }
}
