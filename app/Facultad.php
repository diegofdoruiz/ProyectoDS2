<?php

namespace proyectDs;

use Illuminate\Database\Eloquent\Model;

class Facultad extends Model
{
    protected $table='facultad';
    protected $primaryKey='codigo';
    public $incrementing = false;
    public $timestamps=false;
    protected $fillable = [
    	'codigo',
    	'nombre', 
    	'director', 
    	'estado', 
    ];
    protected $guarded = [];
}
