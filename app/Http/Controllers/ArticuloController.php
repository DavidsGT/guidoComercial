<?php

namespace comercial\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use comercial\Http\Requests;
use comercial\http\Requests\ArticuloFormRequest;
use comercial\Articulo;
use comercial\PgCabecera;
use DB;

class ArticuloController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    public function index(Request $request){
    		if ($request){
    			$query=trim($request->get('searchText'));
    			$articulos=Articulo::where(DB::raw("CONCAT(`codigo`,' ',`nombre`,' ',`descripcion`)"),'LIKE','%'.$query.'%')
                            ->where('estado',true)
                            ->orderBy('codigo')
                			->paginate(12);
    			return view('almacen.articulo.index',["articulo"=>$articulos,"searchText"=>$query]);
    		}
    }

    public function indexstock(Request $request) 
    {
        if ($request){
         try
            {
                $query=trim($request->get('searchText'));
                $articulos=DB::table('articulo as a')
                ->join('pg_detalle as c','a.idcategoria','=','c.id')
            ->select('a.idarticulo','a.nombre','a.codigo','a.stock','a.stockmin','c.descripcion as categoria','a.descripcion','a.imagen','a.estado','a.iva')
                ->whereColumn('a.stock','<=','a.stockmin')
                ->where('a.nombre','LIKE','%'.$query.'%')
                ->orderBy('a.idarticulo','desc')
                ->paginate(7);
            }
        catch(\Illuminate\Database\QueryException $e)
            {
            return 'existe un error' + $e;
            }
                return view('almacen.stockmin.indexstock',["stock"=>$articulos,"searchText"=>$query]);

            }
    }

	public function create()
    {
        return view('almacen.articulo.create',["categorias"=>PgCabecera::find(7)->pgDetalles,"tipoProductos"=>PgCabecera::find(6)->pgDetalles]);
    }

    public function store(Request $request)
    {
    	$articulo=new Articulo;
    	$articulo->nombre=$request->get('nombre');
        $articulo->fk_pg_categoria=$request->get('idcategoria');
    	$articulo->codigo=$request->get('codigo');
    	$articulo->descripcion=$request->get('descripcion');
        $articulo->fk_pg_tipo_producto=$request->get('idTipoProductos');
    	if (Input::exists('imagen')) {
    		$file=Input::file('imagen');
    		$file->move(public_path().'/imagenes/articulos/',$file->getClientOriginalName());
    		$articulo->imagen=$file->getClientOriginalName();
    	}
    	$articulo->save();
    	return Redirect::to('almacen/articulo');
    }

    public function show($id)
    {
    	return view("almacen.articulo.show",["articulo"=>Articulo::findOrFail($id)]);
    }

    public function edit($id)
    {
    	$articulo=Articulo::findOrFail($id);
    	return view("almacen.articulo.edit",["categorias"=>PgCabecera::find(7)->pgDetalles,"tipoProductos"=>PgCabecera::find(6)->pgDetalles,"articulo"=>$articulo]);
    }

    public function update(ArticuloFormRequest $request,$id)
    {
    	$articulo=Articulo::findOrFail($id);
    	
    	$articulo->fk_pg_categoria=$request->get('idcategoria');
        $articulo->fk_pg_tipo_producto=$request->get('idTipoProductos');
    	$articulo->codigo=$request->get('codigo');
    	$articulo->nombre=$request->get('nombre');
    	$articulo->stock=$request->get('stock');
        $articulo->stockmin=$request->get('stockmin');
    	$articulo->descripcion=$request->get('descripcion');
        $articulo->iva=($request->get('iva')==null?false:true);
    	
    	if (Input::exists('imagen')) {
    		$file=Input::file('imagen');
    		$file->move(public_path().'/imagenes/articulos/',$file->getClientOriginalName());
    		$articulo->imagen=$file->getClientOriginalName();
    	}
    	$articulo->update();

    	return Redirect::to('almacen/articulo');
    }

    public function destroy($id)
    {

    	$articulo=Articulo::findOrFail($id);
		$articulo->estado='Inactivo';
		$articulo->update();

    	return Redirect::to('almacen/articulo');
    }
}
