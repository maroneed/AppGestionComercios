<?php

namespace sisVentas\Http\Controllers;

use Illuminate\Http\Request;
use sisVentas\User;
use Illuminate\Support\Facades\Redirect;
use sisVentas\Http\Requests\UsuarioFormRequest;
use Illuminate\Support\Facades\Input;
use DB;







class UsuarioController extends Controller
{
    public function _construct()
    {
        $this->middleware('auth');
         
    }

    public function index(Request $request)
    {
    	if($request)
    	{
    		$query = trim($request->get('searchtext')); // para realizar busquedas por categorias (es un filtro de busqueda)
    		
    		$usuarios =  DB::table('users')
    		->where ('name','LIKE','%'.$query.'%')
    		
        	->orderBy('id','desc')
    		->paginate(7);
    		return View('seguridad.usuario.index',["usuarios" => $usuarios,"searchtext"=>$query]);
    	}
    }

    public function create()
    {
    	return View("seguridad.usuario.create");
    }

    public function store(UsuarioFormRequest $request)
    {
    	$usuario = new User;
    	$usuario->name=$request->get('name');
    	$usuario->email= $request->get('email');
    	$usuario->password= bcrypt($request->get('password'));
    	$usuario->save();  //esto guarda el objeto en la table
    	return Redirect::to('seguridad/usuario');
        

    }

    public function edit($id)
    {
    	return View ("seguridad.usuario.edit",["usuario"=>User::findOrFail($id)]);
    	
    }

    public function update(UsuarioFormRequest $request,$id)
    {
    	$usuario = User::findOrFail($id);
        $usuario->name=$request->get('name');
    	$usuario->email= $request->get('email');
    	$usuario->password= bcrypt($request->get('password'));
    	
    	$usuario->update();
    	return Redirect ::to ('seguridad/usuario');

    }

    public function destroy ($id)
    {
    	$usuario = DB::table('users')->where('id','=',$id)
        ->delete();
    	return Redirect::to('seguridad/usuario');
    }
}
