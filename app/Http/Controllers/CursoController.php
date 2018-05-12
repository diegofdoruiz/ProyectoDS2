<?php

namespace proyectDs\Http\Controllers;

use Illuminate\Http\Request;
use proyectDs\Http\Requests;
use Illuminate\Support\Facades\Auth;
use proyectDs\Curso;
use proyectDs\Programa;
use proyectDs\Prerequisito;
use proyectDs\CursoPrograma;
use proyectDs\Http\Controllers\Singleton\LoginSingleton;
use Illuminate\Support\Facades\Redirect;
use proyectDs\Http\Requests\CursoFormRequest;
use BD;

class CursoController extends Controller
{
    public function __construct(){
        //$this->middleware('auth');
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
                ->orwhere([['habilitacion', 'LIKE', '%'.$query.'%'], ['codigo_usuario','=',$codigo_usuario], ['estado','=','1']])
                ->orwhere([['validacion', 'LIKE', '%'.$query.'%'], ['codigo_usuario','=',$codigo_usuario], ['estado','=','1']])
                ->orwhere([['tipo','LIKE','%'.$query.'%'], ['codigo_usuario','=',$codigo_usuario], ['estado','=','1']])
                ->orderBy('codigo', 'desc')
                ->paginate(7);
            }else if($rol == '2'){
                $cursos=\DB::table('curso')
                            ->join('cursos_programas', 'curso.codigo', '=', 'cursos_programas.codigo_curso')
                            ->join('programa','cursos_programas.codigo_programa','=','programa.codigo')
                ->where([['curso.codigo','=',$query], ['curso.estado','=','1'], ['programa.director','=',$codigo_usuario]])
                ->orwhere([['curso.nombre','LIKE','%'.$query.'%'], ['curso.estado','=','1'], ['programa.director','=',$codigo_usuario]])
                ->orwhere([['curso.validacion','LIKE','%'.$query.'%'], ['curso.estado','=','1'], ['programa.director','=',$codigo_usuario]])
                ->orwhere([['curso.habilitacion','LIKE','%'.$query.'%'], ['curso.estado','=','1'], ['programa.director','=',$codigo_usuario]])
                ->orwhere([['curso.tipo','LIKE','%'.$query.'%'], ['curso.estado','=','1'], ['programa.director','=',$codigo_usuario]])
                ->addSelect('curso.codigo', 'curso.nombre', 'curso.creditos', 'curso.horas_magistrales', 'curso.horas_independientes',
                            'curso.validacion', 'curso.habilitacion', 'curso.num_semestre', 'curso.tipo', 'curso.codigo_usuario', 'curso.estado')
                ->orderBy('curso.codigo', 'desc')
                ->paginate(7);
            }else if($rol== '4'){
                $cursos=\DB::table('curso')
                ->where([['codigo','=',$query], ['estado','=','1']])
                ->orwhere([['nombre','LIKE','%'.$query.'%'], ['estado','=','1']])
                ->orwhere([['validacion','LIKE','%'.$query.'%'], ['estado','=','1']])
                ->orwhere([['habilitacion','LIKE','%'.$query.'%'], ['estado','=','1']])
                ->orwhere([['tipo','LIKE','%'.$query.'%'], ['estado','=','1']])
                ->orderBy('codigo', 'desc')
                ->paginate(7);
            }else{
                return Redirect::to('dashboard');
            }
		    return view('aplicacion.curso.index', ["cursos"=>$cursos, "searchText"=>$query]);
    	}
    }
    public function create(){
        $usuario = auth()->user();
    	$programas = \DB::table('programa')->where('estado', '=', '1')->get();
    	return view("aplicacion.curso.create", ["programas"=>$programas]);
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
		$curso->codigo_usuario=$codigo;
		$curso->estado='1';
        $curso->save();
        /*programas*/
        $programas = $request->get('programas');
        if($programas!=NULL){
            $array_programas = explode(' ', $programas);
            foreach ($array_programas as $programa) {
                $cursoprograma = new CursoPrograma;
                $cursoprograma->codigo_curso=$request->get('codigo');
                $cursoprograma->codigo_programa=$programa;
                $cursoprograma->save();
            }
        }
        /*prerequisitos*/
        $seleccionados = $request->get('seleccionados');
        if($seleccionados!=NULL){
            $array_prere = explode(' ', $seleccionados);
            foreach ($array_prere as $pre) {
                $prerequisito = new Prerequisito;
                $prerequisito->codigo_curso=$request->get('codigo');
                $prerequisito->codigo_pre=$pre;
                $prerequisito->save();
            }
        }
		return Redirect::to('curso');
    }
    public function show($codigo){
    	return view("aplicacion.curso.show", ["curso"=>Curso::findOrFail($codigo)]);
    }
    public function edit($codigo){
        $programas_curso = \DB::table('programa')
                                ->join('cursos_programas', 'programa.codigo', '=', 'cursos_programas.codigo_programa')
                                ->where([['cursos_programas.codigo_curso', '=', $codigo], ['programa.estado', '=', '1']])
                                ->addSelect('codigo', 'nombre')->get();
    	
        /*Primero se toma los códigos de programa a los que pertenece este curso que llega*/
        $codigos_programas_curso = CursoPrograma::where('codigo_curso','=',$codigo)->pluck('codigo_programa');
        $programas = \DB::table('programa')
                                ->whereNotIn('codigo', $codigos_programas_curso)
                                ->where('estado', '=', '1')
                                ->addSelect('codigo', 'nombre')->get();
        

        $cursos_pre = \DB::table('curso')
                        ->join('prerequisito', 'curso.codigo', '=', 'prerequisito.codigo_pre')
                        ->where('prerequisito.codigo_curso', '=', $codigo)->get();
    	return view("aplicacion.curso.edit", ["curso"=> Curso::findOrFail($codigo), 
                                              "programas_curso"=>$programas_curso,
                                              "programas"=>$programas, 
                                              "cursos_pre"=>$cursos_pre]);
    }
    public function update(CursoFormRequest $request, $codigo){
        $codigo_usuario = auth()->user()->codigo;
    	$curso=Curso::findOrFail($codigo);
		$curso->nombre=$request->get('nombre');
		$curso->creditos=$request->get('creditos');
		$curso->horas_magistrales=$request->get('magistrales');
		$curso->horas_independientes=$request->get('independientes');
		$curso->validacion=$request->get('validacion');
		$curso->habilitacion=$request->get('habilitacion');
		$curso->num_semestre=$request->get('semestre');
		$curso->tipo=$request->get('tipo');
		$curso->codigo_usuario=$codigo_usuario;
        $curso->update();

        /*programas*/
        $progra_borrar = \DB::table('cursos_programas')->where('codigo_curso', '=', $codigo)->addSelect('id')->get();
        foreach ($progra_borrar as $borrar) {
            CursoPrograma::destroy($borrar->id);
        }
        $programas = $request->get('programas');
        if($programas!=NULL){
            $array_progra = explode(' ', $programas);
            foreach ($array_progra as $progra) {
                $curso_programa = new CursoPrograma;
                $curso_programa->codigo_curso=$codigo;
                $curso_programa->codigo_programa=$progra;
                $curso_programa->save();
            }
        }

        /*prerequisitos*/
        $prere_borrar = \DB::table('prerequisito')->where('codigo_curso', '=', $codigo)->addSelect('id')->get();
        foreach ($prere_borrar as $borrar) {
            Prerequisito::destroy($borrar->id);
        }
        $seleccionados = $request->get('seleccionados');
        if($seleccionados!=NULL){
            $array_prere = explode(' ', $seleccionados);
            foreach ($array_prere as $pre) {
                $prerequisito = new Prerequisito;
                $prerequisito->codigo_curso=$curso->codigo;
                $prerequisito->codigo_pre=$pre;
                $prerequisito->save();
            }
        }
    	return Redirect::to('curso');
    }
    public function destroy($codigo){
    	$curso=Curso::findOrFail($codigo);
    	$curso->estado='0';
    	$curso->update();
    	return Redirect::to('curso');
    }

    public function getPrerequisitos(Request $request){
        $numero_semestre = $request->get('semestre');
        $codigo_curso = $request->get('codigo');

        /*Primero se toma los códigos prerequisito de este curso que llega*/
        $codigos_prerequisitos_curso = Prerequisito::where('prerequisito.codigo_curso','=',$codigo_curso)->pluck('codigo_pre');
        
        /*Se toman los cursos que aún no son prerequisito y además que no sea el mismo curso y que este en semestres inferiores*/
        $cursos = \DB::table('curso')
                    ->whereNotIn('codigo',$codigos_prerequisitos_curso)
                    ->where([['estado', '=', '1'], ['num_semestre', '<', $numero_semestre], ['codigo','!=',$codigo_curso]])
                    ->addSelect('codigo', 'nombre', 'num_semestre')->get();
        return response($cursos, 200)
                  ->header('Content-Type', 'text/plain');
    }
}
