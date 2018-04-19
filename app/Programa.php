<?php

namespace proyectDs;

use Illuminate\Database\Eloquent\Model;

class Programa extends Model
{
    protected $table='programa';
    protected $primaryKey='codigo';
    public $incrementing = false;
    public $timestamps=false;
    protected $fillable = [
    	'codigo',
    	'nombre', 
    	'num_semestres', 
    	'creditos', 
    	'codigo_escuela', 
    	'estado', 
    	'director',
    ];
    protected $guarded = [];
}
