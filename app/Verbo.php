<?php

namespace proyectDs;

use Illuminate\Database\Eloquent\Model;

class Verbo extends Model
{
    protected $table='verbos';
    protected $primaryKey='codigo';
    public $timestamps=false;
    protected $fillable = [
    	'verbo',
    ];
    protected $guarded = [];
}
