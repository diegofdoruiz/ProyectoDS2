<?php

namespace proyectDs;

use Illuminate\Database\Eloquent\Model;

class ResultadoAprendizaje extends Model
{
    protected $table='res_aprendizaje';
    protected $primaryKey='codigo';
    public $timestamps=false;
    protected $fillable = [
    	'descripcion',
    	'codigo_competencia',
    ];
    protected $guarded = [];
}
