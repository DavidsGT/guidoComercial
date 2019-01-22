<?php

namespace comercial\Http\Controllers;

use Illuminate\Http\Request;

use comercial\Http\Requests;

use comercial\User;
use Illuminate\Support\Facades\Redirect;
use comercial\http\Requests\UsuarioFormRequest;
use DB;


class UsuarioController extends Controller
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
    			$usuarios=DB::table('users as u')
    			->join('perfil as t','t.idperfil','=','u.tipo')
                ->select('u.id','u.name','u.email','u.tipo','t.detalle')
                ->where('u.name','LIKE','%'.$query.'%')
    			->orderBy('u.id','desc')
				->paginate(7);

    	return view('seguridad.usuario.index',["usuarios"=>$usuarios,"searchText"=>$query]);

    	}
 	}
    public function create()
    {
        $perfil=DB::table('perfil')
        ->where('estado','=','1')
        ->get();
        
    	return view('seguridad.usuario.create',["perfil"=>$perfil]);
    }

    public function store(UsuarioFormRequest $request)
   	{
    	$usuario=new User;
    	$usuario->name=$request->get('name');
    	$usuario->email=$request->get('email');
    	$usuario->password=bcrypt($request->get('password'));
        $usuario->cajero=$request->get('cajero');
        $usuario->tipo=$request->get('tipo');
    	$usuario->save();


    	return Redirect::to('seguridad/usuario');
    }

     public function edit($id)
    {

        $perfil=DB::table('perfil')
        ->where('estado','=','1')
        ->get();

    	return view("seguridad.usuario.edit",["usuario"=>User::findOrFail($id),"perfil"=>$perfil]);

    }

    public function update(UsuarioFormRequest $request,$id)
    {
    	$usuario=User::findOrFail($id);
    	$usuario->name=$request->get('name');
    	$usuario->email=$request->get('email');
    	$usuario->password=bcrypt($request->get('password'));
        $usuario->cajero=$request->get('cajero');
        $usuario->tipo=$request->get('tipo');
    	$usuario->update();
    	return Redirect::to('seguridad/usuario');
    }

    public function destroy($id)
    {

    	$usuario=DB::table('users')
    	->where('id','=',$id)
    	->delete();
	    return Redirect::to('seguridad/usuario');
    }

     public function inicio(Request $request)
    {
            return view('control.inicio.index');
    }

 }
