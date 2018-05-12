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
        $this->middleware('auth');
    }
    abstract protected function setAlgoritmo($algoritmo);
    public function index(Request $request){
        if (Auth()->check()) {
            $rol = auth()->user()->rol;
        }else{
            return Redirect::to('dashboard'); //Si no ha iniciado sesión debe ir al login
        }
        
        if($rol != '4'){
            return Redirect::to('dashboard'); //Si no es administrador, no puede ver los usuarios
        }
    	if($request){
    		$query=trim($request->get('searchText'));
            $usuarios=\DB::table('usuario')
                ->join('rol', 'usuario.rol','=','rol.codigo')
                ->join('escuela', 'usuario.codigo_escuela', '=', 'escuela.codigo')
                ->where([['usuario.codigo','=',$query],['usuario.estado','=','1']])
                ->orwhere([['usuario.primer_nombre','LIKE','%'.$query.'%'], ['usuario.estado','=','1']])
                ->orwhere([['usuario.segundo_nombre','LIKE','%'.$query.'%'], ['usuario.estado','=','1']])
                ->orwhere([['usuario.primer_apellido','LIKE','%'.$query.'%'], ['usuario.estado','=','1']])
                ->orwhere([['usuario.segundo_apellido','LIKE','%'.$query.'%'], ['usuario.estado','=','1']])
                ->orwhere([['usuario.name','LIKE','%'.$query.'%'], ['usuario.estado','=','1']])
                ->orwhere([['usuario.email','LIKE','%'.$query.'%'], ['usuario.estado','=','1']])
                ->orwhere([['rol.rol','LIKE','%'.$query.'%'], ['usuario.estado','=','1']])
                ->orwhere([['escuela.nombre','LIKE','%'.$query.'%'], ['usuario.estado','=','1']])
                ->orderBy('usuario.codigo', 'desc')
                ->addSelect('usuario.codigo', 'usuario.primer_nombre', 'usuario.segundo_nombre', 'usuario.primer_apellido','usuario.segundo_apellido',
                            'usuario.name', 'usuario.email','rol.rol', 'escuela.nombre')
                ->paginate(7);
            //dd($usuarios);
		    return view('aplicacion.usuario.index', ["usuarios"=>$usuarios, "searchText"=>$query]);
    	}
    }
    public function create(){
    	$roles = \DB::table('rol')->where('estado', '=', '1')->get();
        $escuelas = \DB::table('escuela')->where('estado', '=', '1')->get();
    	return view("aplicacion.usuario.create", ["roles"=>$roles, "escuelas"=>$escuelas]);
    }
    public function store(UsuarioFormRequest $request){
		$usuario = new Usuario;
		$usuario->codigo=$request->get('codigo');
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
        $usuario->codigo_escuela=$request->get('escuela');
		$usuario->save();
		return Redirect::to('usuario');
    }
    public function show($codigo){
    	return view("aplicacion.usuario.show", ["usuario"=>Usuario::findOrFail($codigo)]);
    }
    public function edit($codigo){
    	$roles = \DB::table('rol')->where('estado', '=', '1')->get();
        $escuelas = \DB::table('escuela')->where('estado', '=', '1')->get();
    	return view("aplicacion.usuario.edit", ["usuario"=>Usuario::findOrFail($codigo)], ["roles"=>$roles, "escuelas"=>$escuelas]);
    }
    public function update(UsuarioFormRequest $request, $codigo){
    	$usuario=Usuario::findOrFail($codigo);
    	$usuario->primer_nombre=$request->get('primer_nombre');
    	$usuario->segundo_nombre=$request->get('segundo_nombre');
    	$usuario->primer_apellido=$request->get('primer_apellido');
    	$usuario->segundo_apellido=$request->get('segundo_apellido');
    	$usuario->name=$request->get('name');
    	$usuario->rol=$request->get('rol');
    	$usuario->email=$request->get('email');
        if($request->get('password') != NULL){
            $usuario->password=bcrypt($request->get('password'));
        }
        $usuario->remember_token=str_random(10);
        $usuario->codigo_escuela=$request->get('escuela');
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
