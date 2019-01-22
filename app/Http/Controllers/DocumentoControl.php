<?php

namespace comercial\Http\Controllers;

use Illuminate\Http\Request;

use comercial\Http\Requests;
use Illuminate\Support\Facades\Input;
//use comercial\http\Requests\DevolucionRequest;
use Illuminate\Support\Facades\Redirect;
use comercial\Documento;
use comercial\Devolucion;
use DB;
use PDF;

//para controlar fecha/hora
use Carbon\Carbon;
use Response;
use Illuminate\Support\Collection;

class DocumentoControl extends Controller
{
 
  public function __construct()
    {
        $this->middleware('auth');

    }

    public function store(Request $request)
    {
            
           foreach ($request->get('codigocon') as $key => $value) {
             if ($request->get('codigocon')[$key] !='_') { 
               $doc=new Documento;
	           $doc->codigo=$request->get('codigo');
	           $doc->numerodoc=$request->get('comprobante');
	           $doc->proveedor=$request->get('proveedor');
	           $doc->formapago=$request->get('forma');
	           $doc->concepto=$request->get('concepto');
	           $mytime = Carbon::now('America/guayaquil');
	           $doc->fecha=$mytime->toDateTimeString();
	           $doc->estado='PROCESADO';

	           $doc->cuenta= $request->get('codigocon')[$key];
	           $doc->debito=$request->get('debito')[$key];
	          $doc->credito=$request->get('credito')[$key];

	           $doc->save();

	            $doc=Devolucion::findOrFail($request->get('codigo'));
        		$doc->estado='Cerrada';
        		$doc->update();
        	}
        }
     
       return Redirect::to('compras/devoluciones');
//     return Redirect::back();

    }

     public function rptce($ven)
    {
       //$ventas=Ventas::all();
        $ventas=DB::table('documentos')
        ->where('codigo','=',$ven)     
     //   ->whereBetween(DB::raw('substring(v.fecha_hora,1,10)'), array($request->get('date3'), $request->get('date4')))
       // ->orderBy('v.idventa','desc')
      //  ->groupBy('v.idventa','v.fecha_hora','p.nombre','v.tipo_comprobante','v.serie_comprobante','v.numero_comprobante','v.impuesto','v.estado')
         ->get();
        $id = 0;
        $nombre="";
        foreach($ventas as $vent){
      	$id = $vent->codigo;
      	$nombre= $vent->proveedor;
        }

       $pdf=PDF::loadView('reportes.clientes.rptcompegreso',['ventas'=>$ventas,'id'=>$id,'nombre'=>$nombre]);//,'tot'=>$total]);

       return $pdf->stream('reportesventas.pdf');
    }

}