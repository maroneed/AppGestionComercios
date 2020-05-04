<?php

namespace sisVentas\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Barryvdh\DomPDF\Facedes as pdf;
use sisVentas\Http\Requests\VentaFormRequest;
use sisVentas\Venta;
use sisVentas\DetalleVenta;
use DB;

use Carbon\Carbon;
use Response;
use Illuminate\Support\Collection;


class VentaController extends Controller
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
    		
    		$ventas =  DB::table('venta as v')
    		->join('persona as p','v.clienteID','=','p.id')
    		->join('detalle_venta as dv','v.id','=','dv.ventaID')
            ->select ('v.id','v.fecha_hora','p.nombre','v.tipo_comprobante','v.serie_comprobante','v.num_comprobante','v.impuesto','v.estado','v.total_venta')

    		->where ('v.num_comprobante','LIKE','%'.$query.'%')
            ->orwhere ('p.nombre','LIKE','%'.$query.'%')
            ->orwhere ('v.tipo_comprobante','LIKE','%'.$query.'%')

            

    		
        	->orderBy('id','desc')
    		->groupBy('v.id','v.fecha_hora','p.nombre','v.tipo_comprobante','v.serie_comprobante','v.num_comprobante','v.impuesto','v.estado','v.total_venta')
    		->paginate(7);
    		return View('ventas.venta.index',["ventas" => $ventas,"searchtext"=>$query]);
    	}
    }

    public function create()
    {
        
        
    	
        $personas= DB::table('persona')->where('tipo_persona','=','Cliente')->get();
    	$articulos = DB:: table('articulo as art')
    	   ->join('detalle_ingreso as di','art.id','=','di.articuloID')
    	   ->select(DB::raw('CONCAT(art.codigo," ",art.nombre)AS articulo'),'art.id','art.stock',DB::raw('avg(di.precio_venta)as precio_promedio'))
    	   ->where('art.estado','=','Activo')
    	   ->where('art.stock','>','0')
    	   ->groupBy('articulo','art.id','art.stock')
           ->get();

    	   
        return View("ventas.venta.create",["personas"=>$personas,"articulos"=>$articulos]);
    }

    public function store(VentaFormRequest $request)
    {
    	try
        {
             DB::beginTransaction();
            $venta = new Venta;
            $venta->clienteID=$request->get('clienteID');
            $venta->tipo_comprobante=$request->get('tipo_comprobante');
            $venta->serie_comprobante=$request->get('serie_comprobante');
            $venta->num_comprobante=$request->get('num_comprobante');
            $venta->total_venta=$request->get('total_venta');
            
            $mytime = Carbon::now('America/Argentina/Buenos_Aires');
            $venta->fecha_hora=$mytime->toDateTimeString();
            $venta->impuesto =21;
            $venta->estado ='A';
            $venta->usuarioID=\Auth::user()->id;
            $venta->save();
            
            
            $articuloID = $request->get('articuloID');
            $cantidad = $request->get('cantidad');
            $descuento = $request->get('descuento');
            $precio_venta = $request->get('precio_venta');
            
            $cont = 0;

            while($cont < count($articuloID))
            {
                $detalle = new DetalleVenta();
                $detalle->ventaID = $venta->id;
                $detalle->articuloID= $articuloID[$cont];
                $detalle->cantidad=$cantidad[$cont];
                $detalle->descuento=$descuento[$cont];
                $detalle->precio_venta=$precio_venta[$cont];
                
                $detalle->save();
                $cont = $cont + 1;
            }   

            DB::commit();
        }

        catch(\Exception $e)
        {
            DB::rollback();
        }
    		
    	

    	return Redirect::to('ventas/venta');
        
    }

    public function show($id)
    {
        $venta= DB::table('venta as v')
    		->join('persona as p','v.clienteID','=','p.id')
    		->join('detalle_venta as dv','v.id','=','dv.VentaID')
            ->select ('v.id','v.fecha_hora','p.nombre','v.tipo_comprobante','v.serie_comprobante','v.num_comprobante','v.impuesto','v.estado','v.total_venta')
            ->where('v.id','=',$id)
            
            ->first();

        $detalles=DB::table('detalle_venta as d')
        ->join('articulo as a','d.articuloID','=','a.id')
        ->select('a.nombre as articulo','d.cantidad','d.descuento','d.precio_venta')
        ->where('d.ventaID','=',$id)
        ->get();
        
        return View("ventas.venta.show",["venta"=>$venta,"detalles"=>$detalles]);
    }

    public function destroy ($id)
    {
    	$venta=Venta::FindOrFail($id);
    	$venta->Estado='C';
    	$venta->update();
    	return Redirect::to('ventas/venta');
    }

    public function imprimir(){
        
        $dato = Venta::get();

        $pdf = \PDF ::loadView('imprimir-ventas',compact('dato')); //nombre de la vista
        return $pdf->stream('reporte.pdf');
    }
    public function imprimirVenta(Request $request,$id){
        
        
        
        $vent= Venta::join ('persona as p','venta.clienteID','=','p.id')
            
            ->select ('venta.id','venta.fecha_hora','p.nombre','venta.tipo_comprobante','venta.serie_comprobante','venta.num_comprobante','venta.impuesto','venta.estado','venta.total_venta','p.nombre','p.tipo_documento','p.num_documento','p.direccion','p.email','p.telefono','venta.usuarioID')
            
            ->where('venta.id','=',$id)
            
            ->orderBy('venta.id','desc')->take(1)->get();

        $deta= DetalleVenta::join ('articulo as a','detalle_venta.articuloID','=','a.id')
        ->select('a.nombre as articulo','detalle_venta.cantidad','detalle_venta.descuento','detalle_venta.precio_venta')
        ->where('detalle_venta.ventaID','=',$id)
        ->orderBy('detalle_venta.id','desc')->get();
        
        $numventa = Venta::select('num_comprobante')->where('id',$id)->get();
        
        $pdf = \PDF ::loadView('imprimir-venta',['vent'=>$vent,'deta'=>$deta]); //nombre de la vista
        return $pdf->stream('reporte.pdf'.$numventa[0]->num_comprobante.'.pdf');
    }
}
