<?php

namespace proyectDs;

use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    protected $table='curso';
    protected $primaryKey='codigo';
    public $incrementing = false;
    public $timestamps=false;
    protected $fillable = [
    	'codigo',
    	'nombre',
    	'creditos',
    	'horas_magistrales',
    	'horas_independiente',
    	'validacion',
    	'habilitacion',
    	'num_semestre',
    	'tipo',
    	'codigo_usuario',
    	'estado'
    ];
    protected $guarded = [];
}
