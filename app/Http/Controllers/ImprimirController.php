<?php

namespace sisVentas\Http\Controllers;

use Illuminate\Http\Request;

class ImprimirController extends Controller
{
    public function imprimir(){
        
        $pdf = \PDF ::loadView('imprimir'); //nombre de la vista
        return $pdf->stream('reporte.pdf');
    }


}
