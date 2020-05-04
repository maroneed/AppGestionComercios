<?php

namespace sisVentas\Http\Controllers;

use Illuminate\Http\Request;
use sisVentas\Persona;  //el modelo
use Illuminate\Support\Facades\Redirect;
use sisVentas\Http\Requests\PersonaFormRequest;  //el request
use DB;
class ProveedorController extends Controller
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
    		->where('tipo_persona','=','Proveedor')
            ->orwhere ('num_documento','LIKE','%'.$query.'%')
    		->where('tipo_persona','=','Proveedor')
        	->orderBy('id','desc')
    		->paginate(7);
    		return View('compras.proveedor.index',["personas" => $personas,"searchtext"=>$query]);
    	}
    }

    public function create()
    {
    	return View ("compras.proveedor.create");
    }

    public function store(PersonaFormRequest $request)
    {
    	$persona = new Persona;
    	$persona->tipo_persona="Proveedor";
    	$persona->nombre=$request->get('nombre');
    	$persona->tipo_documento= $request->get('tipo_documento');
    	$persona->num_documento= $request->get('num_documento');
    	$persona->direccion= $request->get('direccion');
    	$persona->telefono= $request->get('telefono');
    	$persona->email= $request->get('email');
        
        $persona->save();  //esto guarda el objeto en la table
    	return Redirect::to('compras/proveedor');


    }

    public function show($id)
    {
    	return View ("compras.proveedor.show",["persona"=>Persona::findOrFail($id)]);
    }

    public function edit($id)
    {
    	return View ("compras.proveedor.edit",["persona"=>Persona::findOrFail($id)]);
    	
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
    	return Redirect ::to ('compras/proveedor');

    }

    public function destroy($id)
    {
    	$persona = Persona::findOrFail($id);
    	$persona->tipo_persona = 'Inactivo';
    	$persona->update();
    	return Redirect::to('compras/proveedor');
    }
    public function imprimir(){
        
        $prov = Persona::get()->where('tipo_persona','=','Proveedor');

        $pdf = \PDF ::loadView('imprimir-proveedor',compact('prov')); //nombre de la vista
        return $pdf->stream('reporte-proveedores.pdf');
    }
}
