<?php

namespace proyectDs;

use Illuminate\Database\Eloquent\Model;

class Competencia extends Model
{
    protected $table='competencias';
    protected $primaryKey='codigo';
    public $timestamps=false;
    protected $fillable = [
    	'descripcion',
    	'codigo_curso',
    ];
    protected $guarded = [];
}
