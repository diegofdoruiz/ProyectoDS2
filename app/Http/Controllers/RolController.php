<?php

namespace proyectDs\Http\Controllers;

use Illuminate\Http\Request;
use proyectDs\Http\Requests;
use proyectDs\Rol;
use Illuminate\Support\Facades\Redirect;
use proyectDs\Http\Requests\RolFormRequest;
//use proyectDs\Http\Requests\RolController;
use BD;

class RolController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    public function index(Request $request){
        $rol = auth()->user()->rol;
        if($rol != '4'){
            return Redirect::to('dashboard'); //Si no es administrador, no puede ver los usuarios
        }
    	if($request){
    		$query=trim($request->get('searchText'));
    		$roles=\DB::table('rol')->where('rol','LIKE','%'.$query.'%')
    							   ->where('estado','=','1')
    							   ->orderBy('codigo', 'desc')
    							   ->paginate(7);
		    return view('aplicacion.rol.index', ["roles"=>$roles, "searchText"=>$query]);
    	}
    }
    public function create(){
    	return view("aplicacion.rol.create");
    }
    public function store(RolFormRequest $request){
		$rol = new Rol;
		$rol->rol=$request->get('rol');
		$rol->estado='1';
		$rol->save();
		return Redirect::to('rol');
    }
    public function show($codigo){
    	return view("aplicacion.rol.show", ["rol"=>Rol::findOrFail($codigo)]);
    }
    public function edit($codigo){
    	return view("aplicacion.rol.edit", ["rol"=>Rol::findOrFail($codigo)]);
    }
    public function update(RolFormRequest $request, $codigo){
    	$rol=Rol::findOrFail($codigo);
    	$rol->rol=$request->get('rol');
    	$rol->update();
    	return Redirect::to('rol');
    }
    public function destroy($codigo){
    	$rol=Rol::findOrFail($codigo);
    	$rol->estado='0';
    	$rol->update();
    	return Redirect::to('rol');
    }
}
