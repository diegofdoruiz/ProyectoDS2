<?php

namespace proyectDs;

use Illuminate\Database\Eloquent\Model;

class IndicadorLogro extends Model
{
    protected $table='indicador_logro';
    protected $primaryKey='codigo';
    //public $incrementing = false;
    public $timestamps=false;
    protected $fillable = [
    	'descripcion',
    	'codigo_res_aprendizaje',
    ];
    protected $guarded = [];
}
