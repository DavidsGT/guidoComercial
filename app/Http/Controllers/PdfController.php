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


class PdfController extends Controller
{
    public function index()
    {

        return view('reportes.clientes.menurpt');
     
    }
   
     public function getPDFV(Request $request)
    {
       //$ventas=Ventas::all();
          			$ventas=DB::table('venta as v')
    			->join('persona as p','v.idcliente','=','p.idpersona')
    			->join('detalle_venta as dv','dv.idventa','=','v.idventa')
    			->select('v.idventa','v.fecha_hora','p.nombre','v.tipo_comprobante','v.serie_comprobante','v.numero_comprobante','v.impuesto','v.estado','v.total_venta')
      //  ->where('v.estado','=','Cancelado')     
        ->whereBetween(DB::raw('substring(v.fecha_hora,1,10)'), array($request->get('date3'), $request->get('date4')))
        ->orderBy('v.idventa','desc')
        ->groupBy('v.idventa','v.fecha_hora','p.nombre','v.tipo_comprobante','v.serie_comprobante','v.numero_comprobante','v.impuesto','v.estado')
         ->get();
         $total = 0;
        foreach($ventas as $vent){
        $total = $vent->total_venta + $total;
        }

       $pdf=PDF::loadView('reportes.clientes.reportecliente',['ventas'=>$ventas,'tot'=>$total]);

       return $pdf->stream('reportesventas.pdf');
    }

     public function getPDFC(Request $request) 
    {
       //$ventas=Ventas::all();
   
          $ingreso=DB::table('ingreso as i')
          ->join('persona as p','i.idproveedor','=','p.idpersona')
          ->join('detalle_ingreso as di','di.idingreso','=','i.idingreso')
          ->select('i.idingreso','i.fecha_hora','p.nombre','i.tipo_comprobante','i.serie_comprobante','i.numero_comprobante','i.impuesto','i.estado',DB::raw('sum(di.precio_compra*di.cantidad) as total'),'i.estado')
         ->whereBetween(DB::raw('substring(i.fecha_hora,1,10)'), array($request->get('date7'), $request->get('date8')))
         ->where('i.estado','A')
         ->orderBy('i.idingreso','desc')
          ->groupBy('i.idingreso','i.fecha_hora','p.nombre','i.tipo_comprobante','i.serie_comprobante','i.numero_comprobante','i.impuesto','i.estado')
          ->get();

         $totalc = 0;
        foreach($ingreso as $com){
        $totalc = $com->total + $totalc;
        }



       $pdf=PDF::loadView('reportes.clientes.reportecompra',['ingreso'=>$ingreso,'totc'=>$totalc]);

       return $pdf->stream('reportescompras.pdf');
    }


     public function getPDFCL()
    {
       //$ventas=Ventas::all();
   
          $personas=DB::table('persona')
          ->where('tipo_persona','=','Cliente')
          ->where('tipo_documento','=','CEDULA')
          ->orderBy('idpersona','asc')
          ->get();

        $totalp = 0;
        foreach($personas as $com){
        $totalp = $totalp + 1;
        }


      $empresa=DB::table('persona')
          ->where('tipo_documento','=','RUC')
          ->orderBy('idpersona','desc')
          ->get();
            
       $totale = 0;
        foreach($empresa as $come){
        $totale = $totale + 1;
        }   

        $turista=DB::table('persona')
          ->where('tipo_documento','=','PASAPORTE')
          ->orderBy('idpersona','desc')
          ->get();
            
       $totalt = 0;
        foreach($turista as $comt){
        $totalt = $totalt + 1;
        }    
          
       $pdf=PDF::loadView('reportes.clientes.listadoclientes',['personas'=>$personas,'totp'=>$totalp,'empresa'=>$empresa,'tote'=>$totale,'turista'=>$turista,'tott'=>$totalt]);

       return $pdf->stream('reportesclientes.pdf');
    }

     public function getPDFRS()
    {
       //$ventas=Ventas::all();
   
          $personas=DB::table('persona')
          ->where('tipo_persona','=','Cliente')
          ->where('tipo_documento','=','CHOFER')
          ->orderBy('idpersona','asc')
          ->get();

        $totalp = 0;
        foreach($personas as $com){
        $totalp = $totalp + 1;
        }


      $empresa=DB::table('persona')
          ->where('tipo_documento','=','EMPLEADO')
          ->orderBy('idpersona','desc')
          ->get();
            
       $totale = 0;
        foreach($empresa as $come){
        $totale = $totale + 1;
        }   

        $turista=DB::table('persona')
          ->where('tipo_documento','=','PROPIETARIO')
          ->orderBy('idpersona','desc')
          ->get();
            
       $totalt = 0;
        foreach($turista as $comt){
        $totalt = $totalt + 1;
        }    
          
       $pdf=PDF::loadView('reportes.clientes.listadoclientes',['personas'=>$personas,'totp'=>$totalp,'empresa'=>$empresa,'tote'=>$totale,'turista'=>$turista,'tott'=>$totalt]);

       return $pdf->stream('reportesclientes.pdf');
    }

      public function getPDFCU(Request $request)
    {
       //$ventas=Ventas::all();
       $cuotas = DB::table('cuotas as c')
       ->join('persona as p','p.idpersona','=','c.idsocio')
       ->where('c.estado','=','1')
       ->whereBetween(DB::raw('substring(c.fechapago,1,10)'), array($request->get('date10'), $request->get('date11')))
       ->get();

        $totalcu = 0;
        foreach($cuotas as $comcu){
        $totalcu = $comcu->valpago + $totalcu;
        }



       $pdf=PDF::loadView('reportes.clientes.reportecuotas',['cuotas'=>$cuotas,'totcu'=>$totalcu]);

       return $pdf->stream('reportescuotas.pdf');
    }

      public function getPDFBI(Request $request)
    {
       //$ventas=Ventas::all();
     $bitacora = DB::table('bitacora as b')
      ->join('novedades as n','n.idnovedad','=','b.novedades')
      ->join('vehiculos as v','v.idvehiculo','=','b.idchofer')
      ->where('b.estado','1')
      ->whereBetween(DB::raw('substring(b.fecha,1,10)'), array($request->get('date7'), $request->get('date8')))
      ->get();

      $pdf=PDF::loadView('reportes.clientes.reportebitacora',['bitacora'=>$bitacora]);

       return $pdf->stream('reportesbitacora.pdf');
    }

     public function getPDFTV(Request $request)
    {
       //$ventas=Ventas::all();
     $totventa = DB::table('detalle_venta as f')
      ->join('articulo as d','d.idarticulo','=','f.idarticulo')
      ->join('venta as s','s.idventa','=','f.idventa')
      ->join('vehiculos as v','v.idvehiculo','=','s.idvendedor')
      ->join('rutas as r','r.idruta','=','v.idruta')
     ->select('d.nombre',DB::raw('sum(f.cantidad) as cantidad'),DB::raw('sum(f.precio_venta-f.descuento) as total'),'r.descripcion','v.chasis')
       ->whereBetween(DB::raw('substring(s.fecha_hora,1,10)'), array($request->get('date9'), $request->get('date10')))
      ->groupBy('nombre')
      ->get();

        $totalvr = 0;
        foreach($totventa as $com){
        $totalvr = $com->total + $totalvr;
        }

      $pdf=PDF::loadView('reportes.clientes.totventas',['totventa'=>$totventa,'totvr'=>$totalvr]);

       return $pdf->stream('totalventas.pdf');
    }

     public function getPDFTS(Request $request)
    {
       //$ventas=Ventas::all();
     $totvents = DB::table('venta as s')
      ->join('vehiculos as v','v.idvehiculo','=','s.idvendedor')
      ->select('s.idventa','s.fecha_hora','v.propietario','v.chasis','s.total_venta',DB::raw('round(s.total_venta-(s.total_venta*0.20),2) as total_socio'))
     ->whereBetween(DB::raw('substring(s.fecha_hora,1,10)'), array($request->get('date13'), $request->get('date14')))
     // ->groupBy('nombre')
      ->get();

        $totalvs = 0;
        $totalvp = 0;
        foreach($totvents as $com){
        $totalvs = $com->total_venta + $totalvs;
        $totalvp = $com->total_socio + $totalvp;
        }

      $pdf=PDF::loadView('reportes.clientes.totingreso',['totventa'=>$totvents,'totvs'=>$totalvs,'totvp'=>$totalvp]);

       return $pdf->stream('totalventas2.pdf');
    }

     public function getPDFTH(Request $request)
    {
       //$ventas=Ventas::all();
     $totventa = DB::table('detalle_venta as f')
      ->join('articulo as d','d.idarticulo','=','f.idarticulo')
      ->join('venta as s','s.idventa','=','f.idventa')
      ->join('vehiculos as v','v.idvehiculo','=','s.idvendedor')
      ->join('rutas as r','r.idruta','=','v.idruta')
      ->select('d.nombre',DB::raw('sum(f.cantidad) as cantidad'),DB::raw('sum(f.precio_venta-f.descuento) as total'),'r.descripcion','v.chasis')
      ->whereBetween(DB::raw('substring(s.fecha_hora,1,10)'), array($request->get('date11'), $request->get('date12')))
      ->groupBy('nombre')
      ->get();

        $totalvr = 0;
        foreach($totventa as $com){
        $totalvr = $com->total + $totalvr;
        }

      $pdf=PDF::loadView('reportes.clientes.repgeneraling',['totventa'=>$totventa,'totvr'=>$totalvr]);

       return $pdf->stream('totalventas1.pdf');
    }

     public function getPDFGA(Request $request)
    {
       //$ventas=Ventas::all();
     $totvents = DB::table('venta as s')
      ->join('vehiculos as v','v.idvehiculo','=','s.idvendedor')
      ->select('s.idventa','s.fecha_hora','v.propietario','v.chasis','s.total_venta',DB::raw('round(s.total_venta-(s.total_venta*0.20),2) as total_socio'))
     ->whereBetween(DB::raw('substring(s.fecha_hora,1,10)'), array($request->get('date15'), $request->get('date16')))
     // ->groupBy('nombre')
      ->get();

        $totalvs = 0;
        $totalvp = 0;
        foreach($totvents as $com){
        $totalvs = $com->total_venta + $totalvs;
        $totalvp = $com->total_socio + $totalvp;
        }


        $totgana = DB::table('cuotas as s')
      ->join('persona as v','v.idpersona','=','s.idsocio')
      ->select('s.fechapago','v.nombre','s.periodo','s.valpago','s.tipopago')
     ->whereBetween(DB::raw('substring(s.fechapago,1,10)'), array($request->get('date15'), $request->get('date16')))
     // ->groupBy('nombre')
      ->get();

        $totalga = 0;
        //$totalvp = 0;
        foreach($totgana as $com){
        $totalga = $com->valpago + $totalga;
       // $totalvp = $com->total_socio + $totalvp;
        }

      $pdf=PDF::loadView('reportes.clientes.totganancia',['totvents'=>$totvents,'totgana'=>$totgana,'totga'=>$totalga,'totvs'=>$totalvs,'totvp'=>$totalvp]);

       return $pdf->stream('totalganancia.pdf');
    }

  public function getPDFPR($ven)
    {
      $venta = DB::table('venta as v')
                ->join('persona as p','v.idcliente','=','p.idpersona')
                ->join('detalle_venta as dv','dv.idventa','=','v.idventa')
                ->select('v.idventa','v.fecha_hora','p.nombre','p.direccion','p.numero_documento','p.telefono','v.tipo_comprobante','v.serie_comprobante','v.numero_comprobante','v.impuesto','v.estado','v.total_venta','v.idvendedor')
                ->where('v.idventa','=',$ven)
                ->first();
        
        $detalle = DB::table('detalle_venta as d')
        ->join('articulo as a','d.idarticulo','=','a.idarticulo')
        ->select('a.nombre as articulo','a.codigo','d.cantidad','d.descuento','d.precio_venta','d.iddetalle_venta','d.tipoiva')
        ->where('d.idventa','=',$ven)
       ->where('d.estado','=',null)
        ->get();
        

       $pdf=PDF::loadView('reportes.clientes.rptfactura',['ventas'=>$venta,'detalle'=>$detalle]);

       return $pdf->stream('ticek.pdf');
    }
    

    public function conte()
    {
     return view('reportes.contenedor.listacliente',["num"=>'1']);
    }

     public function conte1()
    {
     return view('reportes.contenedor.listacliente',["num"=>'2']);
    }
      public function conte2()
    {
     return view('reportes.contenedor.listacliente',["num"=>'3']);
    }
     public function conte3()
    {
     return view('reportes.contenedor.listacliente',["num"=>'4']);
    }
}
