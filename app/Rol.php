<?php

namespace proyectDs;

use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    protected $table='rol';
    protected $primaryKey='codigo';
    public $incrementing = false;
    public $timestamps=false;
    protected $fillable = [
    	'rol'
    ];
    protected $guarded = [];
}
