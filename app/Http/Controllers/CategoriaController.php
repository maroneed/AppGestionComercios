<?php

namespace sisVentas\Http\Controllers;

use Illuminate\Http\Request;
use sisVentas\Categoria;
use Illuminate\Support\Facades\Redirect;
use sisVentas\Http\Requests\CategoriaFornRequest;
use DB;


class CategoriaController extends Controller
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
    		
    		$categorias =  DB::table('categoria')-> where ('nombre','LIKE','%'.$query.'%')
    		->where('condicion','=','1')
    		->orderBy('id','desc')
    		->paginate(7);
    		return View('almacen.categoria.index',["categorias" => $categorias,"searchtext"=>$query]);
    	}
    }

    public function create()
    {
    	return View ("almacen.categoria.create");
    }

    public function store(CategoriaFornRequest $request)
    {
    	$categoria = new Categoria;
    	$categoria->nombre=$request->get('nombre');
    	$categoria->descripcion=$request->get('descripcion');
    	$categoria->condicion= 1;
    	$categoria->save();  //esto guarda el objeto en la table
    	return Redirect::to('almacen/categoria');


    }

    public function show($id)
    {
    	return View ("almacen.categoria.show",["categoria"=>Categoria::findOrFail($id)]);
    }

    public function edit($id)
    {
    	return View ("almacen.categoria.edit",["categoria"=>Categoria::findOrFail($id)]);
    	
    }

    public function update(CategoriaFornRequest $request,$id)
    {
    	$categoria = Categoria::findOrFail($id);
    	$categoria -> nombre = $request->get('nombre');
    	$categoria -> descripcion = $request->get('descripcion');
    	$categoria->update();
    	return Redirect ::to ('almacen/categoria');

    }

    public function destroy($id)
    {
    	$categoria = Categoria::findOrFail($id);
    	$categoria->condicion = '0';
    	$categoria->update();
    	return Redirect::to('almacen/categoria');
    }
    public function imprimir(){
        
        $cate = Categoria::get();

        $pdf = \PDF ::loadView('imprimir-categoria',compact('cate')); //nombre de la vista
        return $pdf->stream('reporte-categorias.pdf');
    }
}
