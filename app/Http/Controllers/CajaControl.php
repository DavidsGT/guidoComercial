<?php

namespace comercial\Http\Controllers;

use Illuminate\Http\Request;

use comercial\Http\Requests;
use comercial\Caja;
use Illuminate\Support\Facades\Redirect;
//use comercial\http\Requests\BancosFormRequest;
use DB;
use Carbon\Carbon;
use Response;
use Illuminate\Support\Collection;

class CajaControl extends Controller
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
    			$caja=DB::table('acaja')->where('usuario','LIKE','%'.$query.'%')
    			->orderBy('fechaap','asc')
    			->paginate(7);

    			return view('ventas.apertura.index',["apertura"=>$caja,"searchText"=>$query]);

    		}
    }

    public function create()
    {
    	 $caja = DB::table('acaja')
      
        ->get();

        return view('ventas.apertura.create',['apertura'=>$caja]);

    }

    public function store(Request $request)
    {
        $cajaanterior = DB::table('acaja as a')
              ->select('a.idacaja')
              ->where('a.estado','=',1)
              ->whereDate('a.fechaap', '<', Carbon::now('America/guayaquil'))
              ->orderBy('a.fechaap','desc')
              ->first();
        if(!empty($cajaanterior)){
            return view("ventas.apertura.edit",["apertura"=>Caja::findOrFail($cajaanterior->idacaja)]);
        }else{
            $caja=new Caja;
            $mytime = Carbon::now('America/guayaquil');
            $caja->fechaap=$mytime->toDateTimeString();
            $caja->usuario=$request->get('usuario');
            $caja->valorini=$request->get('valorini');
            $caja->novedad=$request->get('novedad');
            $caja->estado='1';
            $caja->save();
            return Redirect::to('ventas/apertura');    
        }
    	
    }

     public function edit($id)
	    {
			return view("ventas.apertura.edit",["apertura"=>Caja::findOrFail($id)]);
	    }

    public function update(Request $request,$id)
    {
    	$caja=Caja::findOrFail($id);
    	$mytime = Carbon::now('America/guayaquil');
        $caja->fechacie=$mytime->toDateTimeString();
        $caja->usuarioc=$request->get('usuarioc');
        $caja->valorfin=$request->get('valorfin');
    	$caja->novedadc=$request->get('novedadc');
    	$caja->estado='0';
    	$caja->update();
    	return Redirect::to('ventas/apertura');
    }

     public function destroy($id)
    {

    	$caja=Caja::findOrFail($id);
		$caja->estado='2';
		$caja->update();

    	return Redirect::to('ventas/apertura');
    }
}
