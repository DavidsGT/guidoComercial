<?php

namespace comercial\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use comercial\Http\Requests;
use comercial\http\Requests\MenuRequest;
use comercial\Asignamenu;
use DB;


class MenuControl extends Controller
{
      public function index(Request $request)
    {

    		if ($request)
    		{
    			$query=trim($request->get('searchText'));
    			$menu=DB::table('menu')
    			  ->where('dethijo','LIKE','%'.$query.'%')
    		    ->where('estado','=','1')
                ->orderBy('idmenu','desc')
    			->paginate(7);

    			return view('control.menu.index',["menu"=>$menu,"searchText"=>$query]);

    		}
    }


    public function create()
    {
    	$item=DB::table('itenmemu')
    	->get();
         $perfil=DB::table('perfil')
        ->where('estado','=','1')
        ->get();
       return view('control.menu.create',["item"=>$item,"perfil"=>$perfil]);



    }

    public function store(MenuRequest $request)
    {
    	$menu=new Asignamenu;
    	$menu->idpadre=$request->get('idpadre');
    	$menu->detpadre=$request->get('detpadre');
    	$menu->idhijo=$request->get('idhijo');
    	$menu->dethijo=$request->get('dethijo');
    	$menu->link=$request->get('link');
        $menu->usuario=$request->get('usuario');
       	$menu->estado='1';
       
    	$menu->save();
    	return Redirect::to('control/menu');
    }

     public function edit($id)
    {
    	$menu=Asignamenu::findOrFail($id);
    	$op=DB::table('itenmemu')->get();
    	
        return view("control.menu.edit",["menu"=>$menu,"op"=>$op]);
    }

    public function update(MenuRequest $request,$id)
    {
    	$menu=Asignamenu::findOrFail($id);
    	
    	$menu->idpadre=$request->get('idpadre');
    	$menu->detpadre=$request->get('detpadre');
    	$menu->idhijo=$request->get('idhijo');
    	$menu->dethijo=$request->get('dethijo');
    	$menu->link=$request->get('link');
        $menu->usuario=$request->get('usuario');
       	$menu->estado='1';
    	$menu->update();

    	return Redirect::to('control/menu');
    }

     public function destroy($id)
    {

    	$menu=Asignamenu::findOrFail($id);
		$menu->estado='0';
        $menu->usuario='0';
		$menu->update();

    	return Redirect::to('control/menu');
    }
}
