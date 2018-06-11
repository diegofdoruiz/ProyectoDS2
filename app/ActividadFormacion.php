<?php

namespace proyectDs;

use Illuminate\Database\Eloquent\Model;

class ActividadFormacion extends Model
{
    protected $table='actividad_formacion';
    protected $primaryKey='codigo';
    public $timestamps=false;
    protected $fillable = [
    	'nombre',
    	'descripcion',
    	'codigo_res_aprendizaje',
    ];
    protected $guarded = [];
}
