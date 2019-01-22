<?php

namespace comercial\Http\Controllers;

use Illuminate\Http\Request;

use comercial\Http\Requests;
use comercial\Bancos;
use Illuminate\Support\Facades\Redirect;
use comercial\http\Requests\BancosFormRequest;
use DB;

class BancosController extends Controller
{
    //
     public function __construct()
    {
        $this->middleware('auth');

    }

    public function index(Request $request)
    {

    		if ($request)
    		{

    			$query=trim($request->get('searchText'));
    			$bancos=DB::table('entidades')->where('nombre','LIKE','%'.$query.'%')
    			->orderBy('nombre','asc')
    			->paginate(7);

    			return view('entidades.bancos.index',["entidades"=>$bancos,"searchText"=>$query]);

    		}
    }

	public function create()
    {
    	 $plan = DB::table('plancuenta as plan')
        ->select('plan.idplan','plan.codigo','plan.detalle',DB::raw('CONCAT(plan.codigo," - ",plan.detalle) as cuentas'))
       // ->where('ent.estado','=','Activa')
        ->get();

        return view('entidades.bancos.create',['cuentas'=>$plan]);

    }

    public function store(BancosFormRequest $request)
    {
    	$bancos=new Bancos;
    	$bancos->codigo=$request->get('idcod');
        $bancos->tipo=$request->get('tipo');
        $bancos->numero=$request->get('numero');
    	$bancos->nombre=$request->get('nombre');
    	$bancos->estado='Activa';
    	$bancos->save();
    	return Redirect::to('entidades/bancos');
    }

    public function show($id)
    {
    	return view("almacen.categoria.show",["bancos"=>Bancos::findOrFail($id)]);

    }

    public function edit($id)
    {

        $plan = DB::table('plancuenta as plan')
        ->select('plan.idplan','plan.codigo','plan.detalle',DB::raw('CONCAT(plan.codigo," - ",plan.detalle) as cuentas'))
       // ->where('ent.estado','=','Activa')
        ->get();

    	return view("entidades.bancos.edit",["bancos"=>Bancos::findOrFail($id),'cuentas'=>$plan]);
    }

    public function update(BancosFormRequest $request,$id)
    {
    	$bancos=Bancos::findOrFail($id);
    	$bancos->codigo=$request->get('idcod');
        $bancos->tipo=$request->get('tipo');
        $bancos->numero=$request->get('numero');
    	$bancos->nombre=$request->get('nombre');
        $bancos->estado='Activa';
    	$bancos->update();

    	return Redirect::to('entidades/bancos');
    }

    public function destroy($id)
    {

    	$bancos=Bancos::findOrFail($id);
		$bancos->tipo='9';
		$bancos->update();

    	return Redirect::to('entidades/bancos');
    }


}
