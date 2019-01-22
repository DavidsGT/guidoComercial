<?php

namespace comercial\Http\Controllers;

use Illuminate\Http\Request;
use comercial\Http\Requests;
use comercial\Proveedor;
use comercial\PgCabecera;
use Illuminate\Support\Facades\Redirect;
use DB;

class ProveedorController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(Request $request){
    		if ($request)
    		{
    			$query=trim($request->get('searchText'));
                $proveedor = Proveedor::where(DB::raw("CONCAT(`nombre`, ' ', `apellido`, ' ', `numero_documento`)"), 'LIKE', '%'.$query.'%')
                            ->where('estado',true)
                			->orderBy('apellido','desc')
                			->paginate(7);
    			return view('compras.proveedor.index',["personas"=>$proveedor,"searchText"=>$query]);
    		}
    }

	public function create(){
    	return view('compras.proveedor.create',["tipodocumentos"=>PgCabecera::find(2)->pgDetalles]);
    }

    public function store(Request $request){
    	$persona=new Proveedor;
    	$persona->nombre=strtoupper($request->get('nombre'));
        $persona->apellido=strtoupper($request->get('apellido'));
    	$persona->fk_pg_tipo_documento=$request->get('tipo_documento');
    	$persona->numero_documento=$request->get('numero_documento');
    	$persona->direccion=strtoupper($request->get('direccion'));
    	$persona->telefono=$request->get('telefono');
    	$persona->email=$request->get('email');
        $persona->fk_pg_tipo_doc_rep=$request->get('tipo_documento_representante');
    	$persona->num_doc_rep=$request->get('cedularepresenta');
        $persona->nom_completo_rep=strtoupper($request->get('representante'));
        $persona->email_rep=$request->get('emailrepresenta');
        $persona->telefono_rep=$request->get('telefonorepresenta');
    	$persona->save();
    	return Redirect::to('compras/proveedor');
    }

    public function show($id){
    	return view("compras.proveedor.show",["persona"=>Proveedor::findOrFail($id)]);
    }

    public function edit($id){
    	return view("compras.proveedor.edit",["tipodocumentos"=>PgCabecera::find(2)->pgDetalles,"persona"=>Proveedor::findOrFail($id),]);
    }

    public function update(Request $request,$id){
    	$persona=Proveedor::findOrFail($id);
    	$persona->nombre=strtoupper($request->get('nombre'));
        $persona->apellido=strtoupper($request->get('apellido'));
        $persona->fk_pg_tipo_documento=$request->get('tipo_documento');
        $persona->numero_documento=$request->get('numero_documento');
        $persona->direccion=strtoupper($request->get('direccion'));
        $persona->telefono=$request->get('telefono');
        $persona->email=$request->get('email');
        $persona->fk_pg_tipo_doc_rep=$request->get('tipo_documento_representante');
        $persona->num_doc_rep=$request->get('cedularepresenta');
        $persona->nom_completo_rep=strtoupper($request->get('representante'));
        $persona->email_rep=$request->get('emailrepresenta');
        $persona->telefono_rep=$request->get('telefonorepresenta');
    	$persona->update();
    	return Redirect::to('compras/proveedor');
    }

    public function destroy($id){
    	$persona=Proveedor::findOrFail($id);
		$persona->estado=false;
		$persona->update();
    	return Redirect::to('compras/proveedor');
    }
}
