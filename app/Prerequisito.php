<?php

namespace proyectDs;

use Illuminate\Database\Eloquent\Model;

class Prerequisito extends Model
{
    protected $table='prerequisito';
    protected $primaryKey='codigo';
    public $timestamps=false;
    protected $fillable = [
    	'codigo_curso',
    	'codigo_pre',
    ];
    protected $guarded = [];
}
