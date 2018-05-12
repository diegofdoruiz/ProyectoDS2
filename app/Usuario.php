<?php

namespace proyectDs;

//use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Usuario extends Authenticatable
{
    use Notifiable;

    protected $table='usuario';
    protected $primaryKey='codigo';
    public $incrementing = false;
    public $timestamps=false;
    protected $fillable = [
    	'codigo', 
        'primer_nombre', 
        'segundo_nombre', 
        'primer_apellido', 
        'segundo_apellido', 
        'name', 
        'rol', 
        'email', 
        'password', 
        'remember_token',
        'estado',
        'codigo_escuela',
    ];
    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}
