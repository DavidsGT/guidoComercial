<?php
namespace comercial\Http\Controllers;
use Illuminate\Support\Facades\Input;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;
use comercial\Http\Requests;
use comercial\Empleado;
use Illuminate\Support\Facades\Redirect;
use comercial\http\Requests\PersonaFormRequest;
use DB;

class EmpleadoController extends Controller
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
                $personas = DB::select("Select e.*, d.descripcion as cargo from empleado e inner join pg_detalle d on d.id = e.fk_pg_cargo where e.estado = 1 and (e.nombre like '%$query%' or e.apellido like '%$query%' or e.numero_documento like '%$query%') order by e.apellido");
    			$personas = $this->arrayPaginator($personas, $request);
    			return view('ventas.empleado.index',["personas"=>$personas,"searchText"=>$query]);
    		}
    }
    public function codigoexistente(Request $request, $cod)
    {
        if($request->ajax()){
            $empleado = DB::table('empleado as e')
            ->select('e.codigo')
            ->where('e.codigo',$cod)
            ->get();
            return response()->json($empleado);
        }
    }
    public function arrayPaginator($array, $request)
    {
        $page = Input::get('page', 1);
        $perPage = 7;
        $offset = ($page * $perPage) - $perPage;
        return new LengthAwarePaginator(array_slice($array, $offset, $perPage, true), count($array), $perPage, $page,
            ['path' => $request->url(), 'query' => $request->query()]);
    }
	public function create()
    {
        $tipodocumentos =  DB::select("SELECT d.id, d.descripcion from pg_detalle d inner join pg_cabecera c on c.id = d.id_tabla WHERE c.tabla = 'TIPO_DOCUMENTO' AND d.estado = 1");
        $cargos =  DB::select("SELECT d.id, d.descripcion from pg_detalle d inner join pg_cabecera c on c.id = d.id_tabla WHERE c.tabla = 'CARGO' AND d.estado = 1");
    	return view('ventas.empleado.create',["tipodocumentos"=>$tipodocumentos,"cargos"=>$cargos]);
    }

    public function store(PersonaFormRequest $request)
    {
    	$persona=new Empleado;
    	$persona->fk_pg_cargo=$request->get('cargo');
    	$persona->nombre=$request->get('nombre');
        $persona->apellido=$request->get('apellido');
        $persona->codigo=$request->get('codigo');
    	$persona->fk_pg_tipo_doc=$request->get('tipo_documento');
    	$persona->numero_documento=$request->get('numero_documento');
    	$persona->direccion=$request->get('direccion');
    	$persona->telefono=$request->get('telefono');
    	$persona->email=$request->get('email');
        $persona->fecha_nacimiento=$request->get('fecha_nacimiento');
    	$persona->save();
    	return Redirect::to('ventas/empleado');
    }
    //EN ESPERA PARA COLODAR DETALLE
    public function show($id)
    {
    	return view("ventas.empleado.show",["persona"=>Persona::findOrFail($id)]);
    }

    public function edit($id)
    {
        $tipodocumentos =  DB::select("SELECT d.id, d.descripcion from pg_detalle d inner join pg_cabecera c on c.id = d.id_tabla WHERE c.tabla = 'TIPO_DOCUMENTO' AND d.estado = 1");
        $cargos =  DB::select("SELECT d.id, d.descripcion from pg_detalle d inner join pg_cabecera c on c.id = d.id_tabla WHERE c.tabla = 'CARGO' AND d.estado = 1");
    	return view("ventas.empleado.edit",["tipodocumentos"=>$tipodocumentos,"cargos"=>$cargos,"persona"=>Empleado::findOrFail($id)]);
    }

    public function update(Request $request,$id)
    {
    	$persona=Empleado::findOrFail($id);
    	$persona->nombre=$request->get('nombre');
        $persona->apellido=$request->get('apellido');
        $persona->codigo=$request->get('codigo');
    	$persona->fk_pg_tipo_doc=$request->get('tipo_documento');
    	$persona->numero_documento=$request->get('numero_documento');
    	$persona->direccion=$request->get('direccion');
    	$persona->telefono=$request->get('telefono');
    	$persona->email=$request->get('email');
        $persona->fk_pg_cargo=$request->get('cargo');
        $persona->fecha_nacimiento=$request->get('fecha_nacimiento');
    	$persona->update();
    	return Redirect::to('ventas/empleado');
    }

    public function destroy($id)
    {
    	$persona=Empleado::findOrFail($id);
		$persona->estado=0;
		$persona->update();
    	return Redirect::to('ventas/empleado');
    }
}