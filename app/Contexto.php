<?php

namespace proyectDs;

use Illuminate\Database\Eloquent\Model;

class Contexto extends Model
{
    protected $table='contextos';
    protected $primaryKey='codigo';
    public $timestamps=false;
    protected $fillable = [
    	'contexto',
    ];
    protected $guarded = [];
}
