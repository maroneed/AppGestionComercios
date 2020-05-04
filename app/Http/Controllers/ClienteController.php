<?php

namespace sisVentas\Http\Controllers;

use Illuminate\Http\Request;
use sisVentas\Persona;
use Illuminate\Support\Facades\Redirect;
use sisVentas\Http\Requests\PersonaFormRequest;
use DB;

class ClienteController extends Controller
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
    		
    		$personas =  DB::table('persona')
    		->where ('nombre','LIKE','%'.$query.'%')
    		->where('tipo_persona','=','Cliente')
            ->orwhere ('num_documento','LIKE','%'.$query.'%')
    		->where('tipo_persona','=','Cliente')
        	->orderBy('id','desc')
    		->paginate(7);
    		return View('ventas.cliente.index',["personas" => $personas,"searchtext"=>$query]);
    	}
    }

    public function create()
    {
    	return View ("ventas.cliente.create");
    }

    public function store(PersonaFormRequest $request)
    {
    	$persona = new Persona;
    	$persona->tipo_persona="Cliente";
    	$persona->nombre=$request->get('nombre');
    	$persona->tipo_documento= $request->get('tipo_documento');
    	$persona->num_documento= $request->get('num_documento');
    	$persona->direccion= $request->get('direccion');
    	$persona->telefono= $request->get('telefono');
    	$persona->email= $request->get('email');
        
        $persona->save();  //esto guarda el objeto en la table
    	return Redirect::to('ventas/cliente');


    }

    public function show($id)
    {
    	return View ("ventas.cliente.show",["persona"=>Persona::findOrFail($id)]);
    }

    public function edit($id)
    {
    	return View ("ventas.cliente.edit",["persona"=>Persona::findOrFail($id)]);
    	
    }

    public function update(PersonaFormRequest $request,$id)
    {
    	$persona = Persona::findOrFail($id);
        $persona->nombre=$request->get('nombre');
    	$persona->tipo_documento= $request->get('tipo_documento');
    	$persona->num_documento= $request->get('num_documento');
    	$persona->direccion= $request->get('direccion');
    	$persona->telefono= $request->get('telefono');
    	$persona->email= $request->get('email');
    	$persona->update();
    	return Redirect ::to ('ventas/cliente');

    }

    public function destroy($id)
    {
    	$persona = Persona::findOrFail($id);
    	$persona->tipo_persona = 'Inactivo';
    	$persona->update();
    	return Redirect::to('ventas/cliente');
    }
    public function imprimir(){
        
        $clie = Persona::get()->where('tipo_persona','=','Cliente');

        $pdf = \PDF ::loadView('imprimir-cliente',compact('clie')); //nombre de la vista
        return $pdf->stream('reporte-clientes.pdf');
    }
}
