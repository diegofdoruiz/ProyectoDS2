<?php

namespace proyectDs;

use Illuminate\Database\Eloquent\Model;

class Proposito extends Model
{
    protected $table='propositos';
    protected $primaryKey='codigo';
    public $timestamps=false;
    protected $fillable = [
    	'proposito',
    ];
    protected $guarded = [];
}
