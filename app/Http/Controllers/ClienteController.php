<?php
namespace comercial\Http\Controllers;
use Illuminate\Support\Facades\Input;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;
use comercial\Http\Requests;
use comercial\Cliente;
use comercial\PgCabecera;
use comercial\PgDetalle;
use Illuminate\Support\Facades\Redirect;
use comercial\http\Requests\PersonaFormRequest;
use DB;

class ClienteController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    public function index(Request $request){
    		if ($request){
    			$query=trim($request->get('searchText'));
                $clientes = Cliente::where('estado',true)
                            ->where(DB::raw("CONCAT(`nombre`, ' ', `apellido`, ' ', `numero_documento`)"), 'LIKE', '%'.$query.'%')
                            ->orderBy('apellido')
                            ->paginate(7);
    			return view('ventas.cliente.index',["personas"=>$clientes,"searchText"=>$query]);
    		}
    }
	public function create(){
    	return view('ventas.cliente.create',["tipodocumentos"=>PgCabecera::find(2)->pgDetalles,"tipoclientes"=>PgCabecera::find(3)->pgDetalles]);
    }

    public function store(PersonaFormRequest $request){
    	$persona=new Cliente;
    	$persona->fk_pg_tipo_cliente=$request->get('tipo_cliente');
    	$persona->nombre=strtoupper($request->get('nombre'));
        $persona->apellido=strtoupper($request->get('apellido'));
    	$persona->fk_pg_tipo_documento=$request->get('tipo_documento');
    	$persona->numero_documento=$request->get('numero_documento');
    	$persona->direccion=strtoupper($request->get('direccion'));
    	$persona->telefono=$request->get('telefono');
    	$persona->email=$request->get('email');
        $persona->fecha_nacimiento=$request->get('fecha_nacimiento');
    	$persona->save();
    	return Redirect::to('ventas/cliente');
    }
    public function show($id){
    	return view("ventas.cliente.show",["persona"=>Persona::findOrFail($id)]);
    }
    public function edit($id){
    	return view("ventas.cliente.edit",["tipodocumentos"=>PgCabecera::find(2)->pgDetalles,"tipoclientes"=>PgCabecera::find(3)->pgDetalles,"persona"=>Cliente::findOrFail($id)]);
    }
    public function update(PersonaFormRequest $request,$id){
    	$persona=Cliente::findOrFail($id);
    	$persona->nombre=strtoupper($request->get('nombre'));
        $persona->apellido=strtoupper($request->get('apellido'));
    	$persona->fk_pg_tipo_documento=$request->get('tipo_documento');
    	$persona->numero_documento=$request->get('numero_documento');
    	$persona->direccion=strtoupper($request->get('direccion'));
    	$persona->telefono=$request->get('telefono');
    	$persona->email=$request->get('email');
        $persona->fk_pg_tipo_cliente=$request->get('tipo_cliente');
        $persona->fecha_nacimiento=$request->get('fecha_nacimiento');
    	$persona->update();
    	return Redirect::to('ventas/cliente');
    }

    public function destroy($id){
    	$persona=Cliente::findOrFail($id);
		$persona->estado=false;
		$persona->update();
    	return Redirect::to('ventas/cliente');
    }
}