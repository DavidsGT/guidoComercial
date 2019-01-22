<?php
namespace comercial\Http\Controllers;
use Illuminate\Support\Facades\Input;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;
use comercial\Http\Requests;
use comercial\Contribuyente;
use Illuminate\Support\Facades\Redirect;
use comercial\http\Requests\PersonaFormRequest;
use DB;

class ContribuyenteController extends Controller
{
      public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request)
    {
    		if ($request)
    		{
                $personas = DB::select("Select *, (select descripcion from pg_detalle where id = fk_pg_tipo_emision) as tipo_emision,(select descripcion from pg_detalle where id = fk_pg_tipo_doc_representante) as tipo_doc,(select descripcion from pg_detalle where id = fk_pg_tipo_ambiente) as tipo_ambiente from Contribuyente where estado = 1");
    			$personas = $this->arrayPaginator($personas, $request);
    			return view('entidades.contribuyente.index',["personas"=>$personas]);
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
        $tipoemisiones =  DB::select("SELECT d.id, d.descripcion from pg_detalle d inner join pg_cabecera c on c.id = d.id_tabla WHERE c.tabla = 'TIPO_EMISION' AND d.estado = 1");
        $tipoambientes =  DB::select("SELECT d.id, d.descripcion from pg_detalle d inner join pg_cabecera c on c.id = d.id_tabla WHERE c.tabla = 'TIPO_AMBIENTE' AND d.estado = 1");
    	return view('entidades.contribuyente.create',["tipoambientes"=>$tipoambientes,"tipodocumentos"=>$tipodocumentos,"tipoemisiones"=>$tipoemisiones]);
    }

    public function store(Request $request)
    {
    	$persona=new Contribuyente;
        $persona->ruc=$request->get('ruc');
        $persona->razon_social=$request->get('razon_social');
        $persona->cod_establecimiento=$request->get('cod_establecimiento');
        $persona->cod_emision=$request->get('cod_emision');
        $persona->direccion_matriz=$request->get('direccion_matriz');
        $persona->telefono=$request->get('telefono');
        $persona->email=$request->get('email');
        $persona->fk_pg_tipo_doc_representante=$request->get('tipo_documento');
        $persona->num_documento=$request->get('num_documento');
        $persona->ruc_contador=$request->get('ruc_contador');
        $persona->lleva_contabilidad=$request->get('lleva_contabilidad');
        $persona->fk_pg_tipo_emision=$request->get('tipo_emision');
        $persona->tiempo_max_espera=$request->get('tiempo_max_espera');
        $persona->fk_pg_tipo_ambiente=$request->get('tipo_ambiente');
        $persona->save();
    	return Redirect::to('entidades/contribuyente');
    }
    //EN ESPERA PARA COLODAR DETALLE
    public function show($id)
    {
    	return view("ventas.cliente.show",["persona"=>Persona::findOrFail($id)]);
    }

    public function edit($id)
    {
        $tipodocumentos =  DB::select("SELECT d.id, d.descripcion from pg_detalle d inner join pg_cabecera c on c.id = d.id_tabla WHERE c.tabla = 'TIPO_DOCUMENTO' AND d.estado = 1");
        $tipoemisiones =  DB::select("SELECT d.id, d.descripcion from pg_detalle d inner join pg_cabecera c on c.id = d.id_tabla WHERE c.tabla = 'TIPO_EMISION' AND d.estado = 1");
        $tipoambientes =  DB::select("SELECT d.id, d.descripcion from pg_detalle d inner join pg_cabecera c on c.id = d.id_tabla WHERE c.tabla = 'TIPO_AMBIENTE' AND d.estado = 1");
    	return view("entidades.contribuyente.edit",["tipoambientes"=>$tipoambientes,"tipodocumentos"=>$tipodocumentos,"tipoemisiones"=>$tipoemisiones,"persona"=>Contribuyente::findOrFail($id)]);
    }

    public function update(Request $request,$id)
    {
    	$persona=Contribuyente::findOrFail($id);
    	$persona->ruc=$request->get('ruc');
        $persona->razon_social=$request->get('razon_social');
    	$persona->cod_establecimiento=$request->get('cod_establecimiento');
    	$persona->cod_emision=$request->get('cod_emision');
    	$persona->direccion_matriz=$request->get('direccion_matriz');
    	$persona->telefono=$request->get('telefono');
    	$persona->email=$request->get('email');
        $persona->fk_pg_tipo_doc_representante=$request->get('tipo_documento');
        $persona->num_documento=$request->get('num_documento');
        $persona->ruc_contador=$request->get('ruc_contador');
        $persona->lleva_contabilidad=$request->get('lleva_contabilidad');
        $persona->fk_pg_tipo_emision=$request->get('tipo_emision');
        $persona->tiempo_max_espera=$request->get('tiempo_max_espera');
        $persona->fk_pg_tipo_ambiente=$request->get('tipo_ambiente');
    	$persona->update();
    	return Redirect::to('entidades/contribuyente');
    }

    public function destroy($id)
    {
    	$persona=Contribuyente::findOrFail($id);
		$persona->estado=0;
		$persona->update();
    	return Redirect::to('entidades/contribuyente');
    }
}