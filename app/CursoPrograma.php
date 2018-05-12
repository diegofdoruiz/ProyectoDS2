<?php

namespace proyectDs;

use Illuminate\Database\Eloquent\Model;

class CursoPrograma extends Model
{
    protected $table='cursos_programas';
    protected $primaryKey='id';
    //public $incrementing = false;
    public $timestamps=false;
    protected $fillable = [
    	'codigo_curso',
    	'codigo_programa',
    ];
    protected $guarded = [];
}
