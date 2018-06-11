<?php

namespace proyectDs;

use Illuminate\Database\Eloquent\Model;

class ActividadEvaluacion extends Model
{
    protected $table='actividad_evaluacion';
    protected $primaryKey='codigo';
    public $timestamps=false;
    protected $fillable = [
    	'nombre',
    	'descripcion',
    	'codigo_indicador_logro',
    ];
    protected $guarded = [];
}
