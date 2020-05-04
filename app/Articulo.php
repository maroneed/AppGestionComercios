<?php

namespace sisVentas;

use Illuminate\Database\Eloquent\Model;

class Articulo extends Model
{
    protected $table = 'articulo';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
       'categoriaID',
       'codigo',
       'nombre',
       'stock',
       'descripcion',
       'imagen',
       'estado'

    ];

    protected $guarded = [
       

    ];

}   