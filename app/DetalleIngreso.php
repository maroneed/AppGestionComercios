<?php

namespace sisVentas;

use Illuminate\Database\Eloquent\Model;

class DetalleIngreso extends Model
{
    protected $table = 'detalle_ingreso';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
       'ingresoID',
       'articuloID',
       'cantidad',
       'precio_compra',
       'precio_venta'
      
       

    ];
}
