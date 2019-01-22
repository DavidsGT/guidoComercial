<?php

namespace comercial\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Response;
use Illuminate\Support\Collection;
use comercial\Http\Requests;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use DB;
use PDF;
//use coopdipor\user;
use comercial\Ventas;
//use fragata\Http\Controllers\Controller;


class RptKardexController extends Controller
{
    public function index(){
        $articulos = DB::table('articulo as art')
        ->join('detalle_ingreso as di','art.idarticulo','=','di.idarticulo')
        ->select(DB::raw('CONCAT(art.codigo," ",art.nombre) as articulo'), 'art.idarticulo','art.stock','di.precio_venta_normal as precio_normal','di.precio_venta_empresarial as precio_empresarial','di.precio_venta_distribucion as precio_distribucion','art.iva','art.stockmin')
        ->where('art.estado','=','Activo')
        ->where('art.stock','>','0')
        ->where('di.precio_venta_normal','>','0')
        ->groupBy('articulo','art.idarticulo','art.stock')
        ->get();
        return view('reportes.contenedor.listakardex',['articulos'=>$articulos]);
    }

    public function getPDFKardex(Request $request){
      if($request->get('idarticulo') != '0' AND $request->get('mes') != '0'){
        
        $kardexs = DB::select("SELECT k.fecha,k.tipo,k.detalle,k.precio_unitario, k.precio_total, k.cantidad, a.codigo, a.nombre as articulo, a.stock, c.nombre as categoria from kardex k inner join articulo a on k.id_articulo = a.idarticulo inner join categoria c on c.idcategoria = a.idcategoria WHERE a.estado = 'Activo' AND a.idarticulo = ".$request->get('idarticulo'));
        $totalIngresos  = 0;
        $totalEgresos  = 0;
        $lastKardex = null;
        $articulo = null;
        $codarticulo = null;
        $cat = null;

        foreach($kardexs as $kar){
            if($articulo == null){
                $articulo = $kar->articulo;
                $codarticulo = $kar->codigo;
                $cat = $kar->categoria;               
            }
            if($kar->tipo == 'E'){
                $totalEgresos = $totalEgresos + $kar->precio_total;
            }else{
                $totalIngresos = $totalIngresos + $kar->precio_total;
            }
        }
        $detarticulo = [
              "articulo" => $articulo,
              "codigo" => $codarticulo,
              "categoria" => $cat
          ];
        $pdf=PDF::loadView('reportes.kardex.rptkardex-producto',['kardexs'=>$kardexs,'det_articulo'=>$detarticulo,'totalingresos'=>$totalIngresos,'totalegresos'=>$totalEgresos]);
        $pdf->setPaper('A4', 'landscape');
        return $pdf->stream('ReporteKardex'.$kar->articulo.'.pdf');
      }
    }
}
