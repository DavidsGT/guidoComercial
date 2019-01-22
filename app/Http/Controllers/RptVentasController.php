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


class RptVentasController extends Controller
{

    public function indexVenta(){
        return view('reportes.contenedor.listaventa');
    }

    public function getPDFVentaDetalladoCajero(Request $request){
      if(($request->get('clasificacion') == 'cajero') and  ($request->get('tipo') == 'detallado')){
        $ventas = DB::table('users as u')
                ->select('u.id as idvendedor','u.name','v.idventa', 'v.tipo_comprobante','v.serie_comprobante', 'v.fecha_hora', 'v.impuesto', 'v.total_venta as subtotal', DB::raw('(v.impuesto + v.total_venta) as total'), 'dv.cantidad','dv.precio_venta as preciounitario', 'dv.descuento', 'dv.tipoiva', 'a.nombre') 
                ->join('venta as v','v.idvendedor','=','u.id')
                ->join('detalle_venta as dv','dv.idventa','=','v.idventa')
                ->join('articulo as a','a.idarticulo','=','dv.idarticulo')
                ->where('u.tipo',2)
                ->where('v.estado','Facturado')
                ->whereBetween(DB::raw('substring(v.fecha_hora,1,10)'), array($request->get('date3'), $request->get('date4')))
                ->orderBy('u.name')
                ->orderBy('v.idventa')
                ->get();
        $total = 0;
        $lastVenta = null;
        foreach($ventas as $vent){
            if(is_null($lastVenta)){
              $total = $vent->total;
            }
            if(!is_null($lastVenta) and ($vent->idventa != $lastVenta->idventa)){
              $total = $vent->total + $total;
            }
            $lastVenta = $vent;
        }
        $pdf=PDF::loadView('reportes.ventas.rptventas-detallado-cajero',['ventas'=>$ventas,'tot'=>$total]);
        return $pdf->stream('reportesventas.pdf');  
      }elseif(($request->get('clasificacion') == 'cajero') and  ($request->get('tipo') == 'general')){
        $ventas = DB::table('users as u')
                ->select('u.id as idvendedor','u.name','v.idventa', 'v.tipo_comprobante','v.serie_comprobante', 'v.fecha_hora', 'v.impuesto', 'v.total_venta as subtotal', DB::raw('(v.impuesto + v.total_venta) as total'))
                ->join('venta as v','v.idvendedor','=','u.id')
                ->where('u.tipo',2)
                ->where('v.estado','Facturado')
                ->whereBetween(DB::raw('substring(v.fecha_hora,1,10)'), array($request->get('date3'), $request->get('date4')))
                ->orderBy('u.name')
                ->orderBy('v.idventa')
                ->get();
        $total = 0;
        $lastVenta = null;
        foreach($ventas as $vent){
            if(is_null($lastVenta)){
              $total = $vent->total;
            }
            if(!is_null($lastVenta) and ($vent->idventa != $lastVenta->idventa)){
              $total = $vent->total + $total;
            }
            $lastVenta = $vent;
        }
        $pdf=PDF::loadView('reportes.ventas.rptventas-general-cajero',['ventas'=>$ventas,'tot'=>$total]);
        return $pdf->stream('reportesventas.pdf'); 
      }elseif(($request->get('clasificacion') == 'categoria') and  ($request->get('tipo') == 'general')){
        $ventas = DB::select('select c.nombre as categoria, a.nombre, sum(dv.cantidad) as cantidad, round(dv.precio_venta,2) as precio_venta, round(sum(dv.cantidad*dv.precio_venta*IFNULL(dv.descuento,0)/100),2) as descuento,round(sum(dv.cantidad*dv.precio_venta*IFNULL(dv.tipoiva,0)/100),2) as iva, GROUP_CONCAT(concat(v.tipo_comprobante,": ",v.serie_comprobante,"-",v.idventa) SEPARATOR "--") as facturas from categoria c inner join articulo a on c.idcategoria = a.idcategoria inner join detalle_venta dv on a.idarticulo = dv.idarticulo inner join venta v on dv.idventa = v.idventa where v.estado = "Facturado" and a.estado = "Activo" and c.condicion=1 and substring(v.fecha_hora,1,10) BETWEEN "'.$request->get('date3').'" AND "'.$request->get('date4').'" GROUP by c.nombre, a.nombre,dv.precio_venta order by c.nombre, a.nombre');
        $total = 0;
        $lastVenta = null;
        foreach($ventas as $vent){
          $total = $total + (($vent->cantidad * $vent->precio_venta) - $vent->descuento + $vent->iva);
        }
        $pdf=PDF::loadView('reportes.ventas.rptventas-general-categoria',['ventas'=>$ventas,'tot'=>$total]);
        return $pdf->stream('reportesventas.pdf'); 
      }elseif(($request->get('clasificacion') == 'categoria') and  ($request->get('tipo') == 'detallado')){
        $ventas = DB::select('select c.nombre as categoria, a.nombre, sum(dv.cantidad) as cantidad, round(dv.precio_venta,2) as precio_venta, round(sum(dv.cantidad*dv.precio_venta*IFNULL(dv.descuento,0)/100),2) as descuento,round(sum(dv.cantidad*dv.precio_venta*IFNULL(dv.tipoiva,0)/100),2) as iva, concat(v.tipo_comprobante,": ",v.serie_comprobante,"-",v.idventa) as facturas from categoria c inner join articulo a on c.idcategoria = a.idcategoria inner join detalle_venta dv on a.idarticulo = dv.idarticulo inner join venta v on dv.idventa = v.idventa where v.estado = "Facturado" and a.estado = "Activo" and c.condicion=1 and substring(v.fecha_hora,1,10) BETWEEN "'.$request->get('date3').'" AND "'.$request->get('date4').'" GROUP by c.nombre, a.nombre,dv.precio_venta, concat(v.tipo_comprobante,": ",v.serie_comprobante,"-",v.idventa) order by c.nombre, a.nombre');
        $total = 0;
        $lastVenta = null;
        foreach($ventas as $vent){
          $total = $total + (($vent->cantidad * $vent->precio_venta) - $vent->descuento + $vent->iva);
        }
        $pdf=PDF::loadView('reportes.ventas.rptventas-detallado-categoria',['ventas'=>$ventas,'tot'=>$total]);
        return $pdf->stream('reportesventas.pdf'); 
      }
    }
}
