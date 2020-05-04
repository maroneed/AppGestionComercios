<?php

namespace sisVentas\Http\Controllers;

use Illuminate\Http\Request;

use sisVentas\Ingreso;
use sisVentas\DetalleIngreso;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Barryvdh\DomPDF\Facedes as pdf;
use sisVentas\Http\Requests\IngresoFormRequest;
use DB;
use Carbon\Carbon;
use Response;
use Illuminate\Support\Collection;


class IngresoController extends Controller
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
    		
    		$ingresos =  DB::table('ingreso as i')
    		->join('persona as p','i.proveedorID','=','p.id')
    		->join('detalle_ingreso as di','i.id','=','di.ingresoID')
            ->select ('i.id','i.fecha_hora','p.nombre','i.tipo_comprobante','i.serie_comprobante','i.num_comprobante','i.impuesto','i.estado',DB::raw('sum(di.cantidad * precio_compra)as total'))

    		->where ('i.num_comprobante','LIKE','%'.$query.'%')
            ->orwhere ('p.nombre','LIKE','%'.$query.'%')
            ->orwhere ('i.tipo_comprobante','LIKE','%'.$query.'%')
            
            
            
        	->orderBy('id','desc')
    		->groupBy('i.id','i.fecha_hora','p.nombre','i.tipo_comprobante','i.serie_comprobante','i.num_comprobante','i.impuesto','i.estado')
    		->paginate(7);
    		return View('compras.ingreso.index',["ingresos" => $ingresos,"searchtext"=>$query]);
    	}
    }

    public function create()
    {
    	$personas= DB::table('persona')->where('tipo_persona','=','Proveedor')->get();
    	$articulos = DB:: table('articulo as art')
    	   ->select(DB::raw('CONCAT(art.codigo," ",art.nombre)AS articulo'),'art.id')
    	   ->where('art.estado','=','Activo')
    	   ->get();
        return View("compras.ingreso.create",["personas"=>$personas,"articulos"=>$articulos]);
    }

    public function store(IngresoFormRequest $request)
    {
    	try
    	{
    		DB::beginTransaction();
    		$ingreso = new Ingreso;
    		$ingreso->proveedorID=$request->get('proveedorID');
    		$ingreso->tipo_comprobante=$request->get('tipo_comprobante');
    		$ingreso->serie_comprobante=$request->get('serie_comprobante');
    		$ingreso->num_comprobante=$request->get('num_comprobante');
            $ingreso->total_ingreso=$request->get('total_ingreso');
            $mytime = Carbon::now('America/Argentina/Buenos_Aires');
    		$ingreso->fecha_hora=$mytime->toDateTimeString();
    		$ingreso->impuesto = 21;
    		$ingreso->usuarioID=\Auth::user()->id;
            $ingreso->estado ='A';
    		$ingreso->save();
            
            $articuloID = $request->get('articuloID');
            $cantidad = $request->get('cantidad');
            $precio_compra = $request->get('precio_compra');
            $precio_venta = $request->get('precio_venta');
            
            $cont = 0;

            while($cont < count($articuloID))
            {
                $detalle = new DetalleIngreso();
                $detalle->ingresoID = $ingreso->id;
                $detalle->articuloID= $articuloID[$cont];
                $detalle->cantidad=$cantidad[$cont];
                $detalle->precio_compra=$precio_compra[$cont];
                $detalle->precio_venta=$precio_venta[$cont];
                $detalle->save();
                $cont = $cont+1;
            }	

            DB::commit();
    	}catch(\Exception $e)
    	{
    		DB::rollback();
    	}

    	return Redirect::to('compras/ingreso');
    }

    public function show($id)
    {
        $ingreso= DB::table('ingreso as i')
    		->join('persona as p','i.proveedorID','=','p.id')
    		->join('detalle_ingreso as di','i.id','=','di.ingresoID')
            ->select ('i.id','i.fecha_hora','p.nombre','i.tipo_comprobante','i.serie_comprobante','i.num_comprobante','i.impuesto','i.estado',DB::raw('sum(di.cantidad * precio_compra)as total'))
            ->where('i.id','=',$id)
            ->groupBy('i.id', 'i.fecha_hora', 'p.nombre', 'i.tipo_comprobante', 'i.serie_comprobante',
            'i.num_comprobante', 'i.impuesto', 'i.estado','p.nombre','p.tipo_documento','p.num_documento','p.direccion','p.telefono','p.email')
            ->first();

        $detalles=DB::table('detalle_ingreso as d')
        ->join('articulo as a','d.articuloID','=','a.id')
        ->select('a.nombre as articulo','d.cantidad','d.precio_compra','d.precio_venta')
        ->where('d.ingresoID','=',$id)
        ->get();
        
        return View("compras.ingreso.show",["ingreso"=>$ingreso,"detalles"=>$detalles]);
    }

    public function destroy ($id)
    {
    	$ingreso=Ingreso::FindOrFail($id);
    	$ingreso->Estado='A';
    	$ingreso->update();
    	return Redirect::to('compras/ingreso');
    }
    public function imprimir(){
        
        $ingr = Ingreso::get();

        $pdf = \PDF ::loadView('imprimir-ingresos',compact('ingr')); //nombre de la vista
        return $pdf->stream('reporte-ingresos.pdf');
    }
    public function imprimirIngreso(Request $request,$id){
        
        
        
        $comp= Ingreso::join('persona as p','ingreso.proveedorID','=','p.id')
            ->join('detalle_ingreso as di','ingreso.id','=','di.ingresoID')
            ->select ('ingreso.id','ingreso.fecha_hora','p.nombre','ingreso.tipo_comprobante','ingreso.serie_comprobante','ingreso.num_comprobante','ingreso.impuesto','ingreso.estado','ingreso.total_ingreso','p.nombre','p.tipo_documento','p.num_documento','p.direccion','p.telefono','p.email','ingreso.usuarioID',DB::raw('sum(di.cantidad * precio_compra)as total'))
            ->where('ingreso.id','=',$id)
            ->groupBy('ingreso.id', 'ingreso.fecha_hora', 'p.nombre', 'ingreso.tipo_comprobante', 'ingreso.serie_comprobante','ingreso.total_ingreso',
            'ingreso.num_comprobante', 'ingreso.impuesto', 'ingreso.estado','p.nombre','p.tipo_documento','p.num_documento','p.direccion','p.telefono','p.email','ingreso.usuarioID')
            ->take(1)->get();

        $detal=DetalleIngreso::join ('articulo as a','detalle_ingreso.articuloID','=','a.id')
        ->select('a.nombre as articulo','detalle_ingreso.cantidad','detalle_ingreso.precio_compra','detalle_ingreso.precio_venta')
        ->where('detalle_ingreso.ingresoID','=',$id)
        ->get();
        
        $numingreso = Ingreso::select('num_comprobante')->where('id',$id)->get();
        $pdf = \PDF ::loadView('imprimir-ingreso',['comp'=>$comp,'detal'=>$detal]); //nombre de la vista
        return $pdf->stream('reporte.pdf'.$numingreso[0]->num_comprobante.'.pdf');
    }
}
