<?php

namespace proyectDs\Http\Controllers;

use Illuminate\Http\Request;
use proyectDs\Http\Requests;
use Illuminate\Support\Facades\Auth;
use proyectDs\Curso;
use proyectDs\programa;
use proyectDs\Http\Controllers\Singleton\LoginSingleton;
use Illuminate\Support\Facades\Redirect;
use proyectDs\Http\Requests\CursoFormRequest;
use BD;

class CursoController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    public function index(Request $request){
        $codigo_usuario = auth()->user()->codigo;
        $rol = auth()->user()->rol;
    	if($request){
    		$query=trim($request->get('searchText'));
            if($rol == '1'){
                $cursos=\DB::table('curso')
                ->where([['codigo','=',$query], ['codigo_usuario','=',$codigo_usuario], ['estado','=','1']])
                ->orwhere([['nombre','LIKE','%'.$query.'%'], ['codigo_usuario','=',$codigo_usuario], ['estado','=','1']])
                ->orderBy('codigo', 'desc')
                ->paginate(7);
            }else if($rol == '2'){
                $programas = (\DB::table('programa')
                ->where('director','=',$codigo_usuario))->first();
                if($programas != NULL){
                    $programa = $programas->codigo;
                }else{
                    $programa = '';
                }
                $cursos=\DB::table('curso')
                ->where([['codigo','=',$query], ['codigo_programa','=',$programa], ['estado','=','1']])
                ->orwhere([['nombre','LIKE','%'.$query.'%'], ['codigo_programa','=',$programa], ['estado','=','1']])
                ->orderBy('codigo', 'desc')
                ->paginate(7);
            }else if($rol== '4'){
                $cursos=\DB::table('curso')
                ->where([['codigo','=',$query], ['estado','=','1']])
                ->orwhere([['nombre','LIKE','%'.$query.'%'], ['estado','=','1']])
                ->orderBy('codigo', 'desc')
                ->paginate(7);
            }else{
                return Redirect::to('dashboard');
            }
		    return view('aplicacion.curso.index', ["cursos"=>$cursos, "searchText"=>$query]);
    	}
    }
    public function create(){
    	$programas = \DB::table('programa')->where('estado', '=', '1')->get();
        $cursos = \DB::table('curso')->where('estado', '=', '1')->get();
        $cursos1 = ['Curso1', 'Curso2', 'Curso3', 'Curso4'];
    	return view("aplicacion.curso.create", ["programas"=>$programas, "cursos"=>$cursos1]);
    }
    public function store(CursoFormRequest $request){
        $codigo = auth()->user()->codigo;
		$curso = new Curso;
		$curso->codigo=$request->get('codigo');
		$curso->nombre=$request->get('nombre');
		$curso->creditos=$request->get('creditos');
		$curso->horas_magistrales=$request->get('magistrales');
		$curso->horas_independientes=$request->get('independientes');
		$curso->validacion=$request->get('validacion');
		$curso->habilitacion=$request->get('habilitacion');
		$curso->num_semestre=$request->get('semestre');
		$curso->tipo=$request->get('tipo');
		$curso->codigo_programa=$request->get('programa');
		$curso->codigo_usuario=$codigo;
		$curso->estado='1';
		$curso->save();
		return Redirect::to('curso');
    }
    public function show($codigo){
    	return view("aplicacion.curso.show", ["curso"=>Curso::findOrFail($codigo)]);
    }
    public function edit($codigo){
    	$programas = \DB::table('programa')->where('estado', '=', '1')->get();
    	return view("aplicacion.curso.edit", ["curso"=> Curso::findOrFail($codigo)], ["programas"=>$programas]);
    }
    public function update(CursoFormRequest $request, $codigo){
        $codigo = auth()->user()->codigo;
    	$curso=Curso::findOrFail($codigo);
		$curso->nombre=$request->get('nombre');
		$curso->creditos=$request->get('creditos');
		$curso->horas_magistrales=$request->get('magistrales');
		$curso->horas_independientes=$request->get('independientes');
		$curso->validacion=$request->get('validacion');
		$curso->habilitacion=$request->get('habilitacion');
		$curso->num_semestre=$request->get('semestre');
		$curso->tipo=$request->get('tipo');
		$curso->codigo_programa=$request->get('programa');
		$curso->codigo_usuario=$codigo;
		$curso->estado=$request->get('estado');
    	$curso->update();
    	return Redirect::to('curso');
    }
    public function destroy($codigo){
    	$curso=Curso::findOrFail($codigo);
    	$curso->estado='0';
    	$curso->update();
    	return Redirect::to('curso');
    }
}
