<?php

namespace comercial\Http\Controllers;

use Illuminate\Http\Request;
use comercial\Http\Requests;
use comercial\PgDetalle;
use Illuminate\Support\Facades\Redirect;
use comercial\http\Requests\CategoriaFormRequest;
use DB;


class CategoriaController extends Controller{
    //
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(Request $request){
		if ($request){
			$query=trim($request->get('searchText'));
			$categorias=PgDetalle::where('descripcion','LIKE','%'.$query.'%')
            			->where('estado','=','1')
                        ->where('id_tabla',7)
            			->orderBy('descripcion','asc')
            			->paginate(7);
			return view('almacen.categoria.index',["categorias"=>$categorias,"searchText"=>$query]);
		}
    }

	public function create()
    {
    	return view('almacen.categoria.create');

    }

    public function store(CategoriaFormRequest $request)
    {
    	$categoria=new PgDetalle;
        $categoria->id_tabla=7;
    	$categoria->descripcion=strtoupper($request->get('nombre'));
    	$categoria->detalle=strtoupper($request->get('descripcion'));
    	$categoria->estado=true;
    	$categoria->save();
    	return Redirect::to('almacen/categoria');
    }

    public function show($id)
    {
    	return view("almacen.categoria.show",["categoria"=>PgDetalle::findOrFail($id)]);

    }

    public function edit($id)
    {

    	return view("almacen.categoria.edit",["categoria"=>PgDetalle::findOrFail($id)]);
    }

    public function update(CategoriaFormRequest $request,$id)
    {
    	$categoria=PgDetalle::findOrFail($id);
    	$categoria->descripcion=strtoupper($request->get('nombre'));
    	$categoria->detalle=strtoupper($request->get('descripcion'));
    	$categoria->update();

    	return Redirect::to('almacen/categoria');
    }

    public function destroy($id)
    {

    	$categoria=PgDetalle::findOrFail($id);
		$categoria->estado=false;
		$categoria->update();

    	return Redirect::to('almacen/categoria');
    }


}
