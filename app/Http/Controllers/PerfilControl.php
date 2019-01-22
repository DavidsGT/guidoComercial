<?php

namespace comercial\Http\Controllers;

use Illuminate\Http\Request;
use comercial\Http\Requests;
use comercial\Perfil;
use Illuminate\Support\Facades\Redirect;
use comercial\http\Requests\PerfilRequest;
use DB;

class PerfilControl extends Controller
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
    			$perfil=DB::table('perfil')->where('detalle','LIKE','%'.$query.'%')
    			->where('estado','=','1')
    			->orderBy('detalle','asc')
    			->paginate(7);

    			return view('seguridad.perfil.index',["perfil"=>$perfil,"searchText"=>$query]);

    		}
    }

    public function create()
    {
    	return view('seguridad.perfil.create');

    }

    public function store(PerfilRequest $request)
    {
    	$perfil=new Perfil;
    	$perfil->detalle=$request->get('detalle');
    	$perfil->descripcion=$request->get('descripcion');
    	$perfil->estado='1';
    	$perfil->save();
    	return Redirect::to('seguridad/perfil');
    }

    public function show($id)
    {
    	return view("seguridad.perfil.show",["perfil"=>Perfil::findOrFail($id)]);

    }

    public function edit($id)
    {

    	return view("seguridad.perfil.edit",["perfil"=>Perfil::findOrFail($id)]);
    }

    public function update(PerfilRequest $request,$id)
    {
    	$perfil=Perfil::findOrFail($id);
    	$perfil->detalle=$request->get('detalle');
    	$perfil->descripcion=$request->get('descripcion');
    	$perfil->update();

    	return Redirect::to('seguridad/perfil');
    }

    public function destroy($id)
    {

    	$perfil=Perfil::findOrFail($id);
		$perfil->estado='0';
		$perfil->update();

    	return Redirect::to('seguridad/perfil');
    }

}
