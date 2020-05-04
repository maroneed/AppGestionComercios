<?php

namespace sisVentas\Http\Controllers;

use Illuminate\Http\Request;


use sisVentas\Articulo;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use sisVentas\Http\Requests\ArticuloFormRequest;
use \Milon\Barcode\DNS2D;


use DB;



class ArticuloController extends Controller
{
    public function _construct($guard)
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
    	if($request)
    	{
    		$query = trim($request->get('searchtext')); // para realizar busquedas por categorias (es un filtro de busqueda)
    		
    		$articulos = DB::table('articulo as a')
    		->join('categoria as c','a.categoriaID','=','c.id')
    		->select('a.id','a.nombre','a.codigo','a.stock','c.nombre as categoria','a.descripcion','a.imagen','a.estado')
    		-> where ('a.nombre','LIKE','%'.$query.'%')
            -> orwhere ('a.codigo','LIKE','%'.$query.'%')
    		->orderBy('a.id','desc')
    		->paginate(7);
    		return View('almacen.articulo.index',["articulos" => $articulos,"searchtext"=>$query]);
    	}
    }

    public function create()
    {
    	$categorias=DB::table('categoria')->where('condicion','=','1')->get();
    	return View ("almacen.articulo.create",["categorias"=>$categorias]);
    }

    public function store(ArticuloFormRequest $request)
    {
    	$articulo = new Articulo;
    	$articulo->categoriaID=$request->get('categoriaID');
    	$articulo->codigo=$request->get('codigo');
    	$articulo->nombre=$request->get('nombre');
    	$articulo->stock=$request->get('stock');
    	$articulo->descripcion=$request->get('descripcion');
    	$articulo->estado='Activo';
        
        if(Input::hasFile('imagen'))
        {
        	$file=Input::file('imagen');
        	$file->move(public_path().'/imagenes/articulos/',$file->getClientOriginalName());
            $articulo->imagen=$file->getClientOriginalName();
        }


        
    	$articulo->save();  //esto guarda el objeto en la table
    	return Redirect::to('almacen/articulo');


    }

    public function show($id)
    {
    	return View ("almacen.articulo.show",["articulo"=>Articulo::findOrFail($id)]);
    }

    public function edit($id)
    {
    	
        $articulo=Articulo::findOrFail($id);
        $categorias=DB::table('categoria')->where('condicion','=','1')->get();
    	return View ("almacen.articulo.edit",["articulo"=>$articulo,"categorias"=>$categorias]);
    	
    }

    public function update(ArticuloFormRequest $request,$id)
    {
    	$articulo = Articulo::findOrFail($id);
    	$articulo->categoriaID=$request->get('categoriaID');
    	$articulo->codigo=$request->get('codigo');
    	$articulo->nombre=$request->get('nombre');
    	$articulo->stock=$request->get('stock');
    	$articulo->descripcion=$request->get('descripcion');
    	$articulo->estado='Activo';
        
        if(input::hasFile('imagen'))
        {
        	$file=Input::file('imagen');
        	$file->move(public_path().'imagenes/articulos',$file->getClientOriginalName());
            $articulo->imagen=$file->getClientOriginalName();
        }
    	$articulo->update();
    	return Redirect ::to ('almacen/articulo');

    }

    public function destroy($id)
    {
    	$articulo = Articulo::findOrFail($id);
    	$articulo->estado = 'Inactivo';
    	$articulo->update();
    	return Redirect::to('almacen/articulo');
    }
    public function imprimir(){
        
        $arti = Articulo::get();

        $pdf = \PDF ::loadView('imprimir-articulo',compact('arti')); //nombre de la vista
        return $pdf->stream('reporte-articulos.pdf');
    }
    public function codigoBarra(Request $request,$id){

        $numero = Articulo::select('codigo')->where('id',$id)->get();
        
        
        
        
        
        $pdf = \PDF ::loadView('imprimir-codigo',['numero'=>$numero]); //nombre de la vista
        return $pdf->stream('reporte.pdf'.$numero.'.pdf');

    }
    
    

}
