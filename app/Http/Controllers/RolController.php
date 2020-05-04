<?php

namespace sisVentas\Http\Controllers;



use Illuminate\Http\Request;
use sisVentas\Rol;
use Illuminate\Support\Facades\Redirect;
use sisVentas\Http\Requests\RolFormRequest;
use Illuminate\Support\Facades\Input;
use DB;

class RolController extends Controller
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
    		
    		$roles =  DB::table('rol')
    		->where ('nombre','LIKE','%'.$query.'%')
    		
        	->orderBy('id','desc')
    		->paginate(7);
    		return View('seguridad.roles.index',["roles" => $roles,"searchtext"=>$query]);
    	}
    }

    
}
