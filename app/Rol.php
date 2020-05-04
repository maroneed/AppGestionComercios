<?php

namespace sisVentas;

use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    protected $table = 'rol';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
       'nombre',
       'descripcion',
       'estado'
       

    ];

    protected $guarded = [
       

    ];
}
