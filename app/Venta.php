<?php

namespace sisVentas;

use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
     protected $table = 'venta';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
       'clienteID',
       'tipo_comprobante',
       'serie_comprobante',
       'num_comprobante',
       'fecha_hora',
       'impuesto',
       'total_venta',
       'estado'
       

    ];

    protected $guarded = [
       

    ];
}
