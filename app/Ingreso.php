<?php

namespace sisVentas;

use Illuminate\Database\Eloquent\Model;

class Ingreso extends Model
{
    protected $table = 'ingreso';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
       'proveedorID',
       'tipo_comprobante',
       'serie_comprobante',
       'num_comprobante',
       'fecha_hora',
       'impuesto',
       'estado'
       

    ];

    protected $guarded = [
       

    ];
}
