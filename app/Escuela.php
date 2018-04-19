<?php

namespace proyectDs;

use Illuminate\Database\Eloquent\Model;

class Escuela extends Model
{
    protected $table='escuela';
    protected $primaryKey='codigo';
    public $incrementing = false;
    public $timestamps=false;
    protected $fillable = [
    	'codigo',
    	'nombre', 
    	'director', 
    	'codigo_facultad', 
    	'estado', 
    ];
    protected $guarded = [];
}
