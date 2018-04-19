<?php

namespace proyectDs\Http\Controllers;

use Illuminate\Http\Request;
use proyectDs\Http\Requests;
use proyectDs\Usuario;
use Illuminate\Support\Facades\Redirect;
use proyectDs\Http\Requests\UsuarioFormRequest;
use BD;

abstract class UsuarioController extends Controller
{
    public function __construct(){

    }
    abstract protected function setAlgoritmo($algoritmo);
    public function index(Request $request){
        $rol = auth()->user()->rol;
        if($rol != '4'){
            return Redirect::to('dashboard'); //Si no es administrador, no puede ver los usuarios
        }
    	if($request){
    		$query=trim($request->get('searchText'));
            $usuarios=\DB::table('usuario')
                ->where([['codigo','=',$query],['estado','=','1']])
                ->orwhere([['primer_nombre','LIKE','%'.$query.'%'], ['estado','=','1']])
                ->orwhere([['segundo_nombre','LIKE','%'.$query.'%'], ['estado','=','1']])
                ->orwhere([['primer_apellido','LIKE','%'.$query.'%'], ['estado','=','1']])
                ->orwhere([['segundo_apellido','LIKE','%'.$query.'%'], ['estado','=','1']])
                ->orwhere([['name','LIKE','%'.$query.'%'], ['estado','=','1']])
                ->orderBy('codigo', 'desc')
                ->paginate(7);
		    return view('aplicacion.usuario.index', ["usuarios"=>$usuarios, "searchText"=>$query]);
    	}
    }
    public function create(){
    	$roles = \DB::table('rol')->where('estado', '=', '1')->get();
    	return view("aplicacion.usuario.create", ["roles"=>$roles]);
    }
    public function store(UsuarioFormRequest $request){
		$usuario = new Usuario;
		$usuario->codigo=$request->get('codigo');
		$usuario->cedula=$request->get('cedula');
		$usuario->primer_nombre=$request->get('primer_nombre');
		$usuario->segundo_nombre=$request->get('segundo_nombre');
		$usuario->primer_apellido=$request->get('primer_apellido');
		$usuario->segundo_apellido=$request->get('segundo_apellido');
		$usuario->name=$request->get('name');
		$usuario->rol=$request->get('rol');
		$usuario->email=$request->get('email');
		$usuario->password=bcrypt($request->get('password'));
        $usuario->remember_token=str_random(10);
		$usuario->estado='1';
		$usuario->save();
		return Redirect::to('usuario');
    }
    public function show($codigo){
    	return view("aplicacion.usuario.show", ["usuario"=>Usuario::findOrFail($codigo)]);
    }
    public function edit($codigo){
    	$roles = \DB::table('rol')->where('estado', '=', '1')->get();
    	return view("aplicacion.usuario.edit", ["usuario"=>Usuario::findOrFail($codigo)], ["roles"=>$roles]);
    }
    public function update(UsuarioFormRequest $request, $codigo){
    	$usuario=Usuario::findOrFail($codigo);
    	//$usuario->codigo=$request->get('codigo');
        //$usuario->cedula=$request->get('cedula');
    	$usuario->primer_nombre=$request->get('primer_nombre');
    	$usuario->segundo_nombre=$request->get('segundo_nombre');
    	$usuario->primer_apellido=$request->get('primer_apellido');
    	$usuario->segundo_apellido=$request->get('segundo_apellido');
    	//$usuario->name=$request->get('name');
    	$usuario->rol=$request->get('rol');
    	//$usuario->email=$request->get('email');
        if($request->get('password') != NULL){
            $usuario->password=bcrypt($request->get('password'));
        }
        $usuario->remember_token=str_random(10);
    	$usuario->update();
    	return Redirect::to('usuario');
    }
    public function destroy($codigo){
    	$usuario=Usuario::findOrFail($codigo);
    	$usuario->estado='0';
    	$usuario->update();
    	return Redirect::to('usuario');
    }
}
