<?php

namespace proyectDs;

use Illuminate\Database\Eloquent\Model;

class Contenido extends Model
{
    protected $table='contenidos';
    protected $primaryKey='codigo';
    public $timestamps=false;
    protected $fillable = [
    	'contenido',
    ];
    protected $guarded = [];
}
