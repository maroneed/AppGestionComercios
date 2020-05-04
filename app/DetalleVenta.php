<?php

namespace sisVentas;

use Illuminate\Database\Eloquent\Model;

class DetalleVenta extends Model
{
    protected $table = 'detalle_venta';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
       'ventaID',
       'articuloID',
       'cantidad',
       'precio_venta',
       'descuento'
      
       

    ];
}
