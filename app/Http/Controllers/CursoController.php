<?php

namespace proyectDs\Http\Controllers;

use Illuminate\Http\Request;
use proyectDs\Http\Requests;
use Illuminate\Support\Facades\Auth;
use proyectDs\Curso;
use proyectDs\Programa;
use proyectDs\Prerequisito;
use proyectDs\CursoPrograma;
use proyectDs\Competencia;
use proyectDs\ResultadoAprendizaje;
use proyectDs\IndicadorLogro;
use proyectDs\ActividadFormacion;
use proyectDs\ActividadEvaluacion;
use proyectDs\Verbo;
use proyectDs\Contenido;
use proyectDs\Contexto;
use proyectDs\Proposito;
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
        $verbos = Verbo::all();
        $contenidos = Contenido::all();
        $contextos = Contexto::all();
        $propositos = Proposito::all(); 
    	return view("aplicacion.curso.show", ["curso"=>Curso::findOrFail($codigo),
                                              "verbos"=>$verbos,
                                              "contenidos"=>$contenidos,
                                              "contextos"=>$contextos,
                                              "propositos"=>$propositos]);
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

    public function crearCompetencia(Request $request){
        $competencia_json_str = $request->get('data');
        # Get as an object
        $competencia_json_obj = json_decode($competencia_json_str, true);

        $comp_curso = $competencia_json_obj['curso'];
        $comp_descripcion = $competencia_json_obj['descripcion'];
        $comp_res_aprendizaje = $competencia_json_obj['resultados_aprendizaje'];
        $curso = Curso::findOrFail($comp_curso);  
        if($curso->codigo == $comp_curso){
            $competencia = new Competencia;
            $competencia->descripcion = $comp_descripcion;
            $competencia->codigo_curso = $comp_curso;
            $saved_comp = $competencia->save();
            if($saved_comp){
                $last_index_compet = Competencia::max('codigo'); //Obtener el último indice de la tabla de competencias. 
                foreach ($comp_res_aprendizaje as $r_a) {
                    $r_a_descripcion = $r_a['descripcion'];
                    $r_a_act_form = $r_a['actividades_formacion'];
                    $r_a_ind_logro = $r_a['indicadores_logro'];

                    $res_aprendizaje = new ResultadoAprendizaje;
                    $res_aprendizaje->descripcion = $r_a_descripcion;
                    $res_aprendizaje->codigo_competencia = $last_index_compet;
                    $saved_r_a = $res_aprendizaje->save();
                    if($saved_r_a){ 
                        $last_index_r_a = ResultadoAprendizaje::max('codigo'); //Obtener el último indice de la tabla de res de aprendizaje.
                        foreach ($r_a_act_form as $a_f) {
                            $act_form = new ActividadFormacion;
                            $act_form->nombre = $a_f['name'];
                            $act_form->descripcion = $a_f['description'];
                            $act_form->codigo_res_aprendizaje = $last_index_r_a;
                            $act_form->save();
                        }
                        $var = "OK";
                        foreach ($r_a_ind_logro as $i_l) {
                            $actis_eval = $i_l['actividades_evaluacion'];
                            $indic_logro = new IndicadorLogro;
                            $indic_logro->descripcion = $i_l['descripcion'];
                            $indic_logro->codigo_res_aprendizaje = $last_index_r_a;
                            $saved_i_l = $indic_logro->save();
                            if($saved_i_l){
                                $last_index_i_l = IndicadorLogro::max('codigo'); //Obtener el último indice de la tabla de indicadores de logros. 
                                foreach ($actis_eval as $a_e) {
                                    $act_eval = new ActividadEvaluacion;
                                    $act_eval->nombre = $a_e['name'];
                                    $act_eval->descripcion = $a_e['descripcion'];
                                    $act_eval->codigo_indicador_logro = $last_index_i_l;
                                    $act_eval->save();
                                }
                            }
                        }
                    }
                }
            }
            return response("OK", 200)
                ->header('Content-Type', 'text/plain');
        }else{
            return response("No exixte el curso", 200)
                   ->header('Content-Type', 'text/plain');
        }
    }

    public function eliminarCompetencia(Request $request){
        $codigo_competencia = $request->get('competencia');
        $deleted = Competencia::destroy($codigo_competencia);
        if($deleted){
            return response("OK", 200)
                   ->header('Content-Type', 'text/plain');
        }

    }

    public function getCompetencias(Request $request){
        $codigo_curso = $request->get('codigo');
        $competencias = Competencia::where('codigo_curso', '=', $codigo_curso)->orderBy('codigo', 'asc')->get();
        $competencias_array = [];
        foreach ($competencias as $competencia) {
            $codigo_comp = $competencia->codigo;
            $descrip_comp = $competencia->descripcion;
            $res_aprendizaje = ResultadoAprendizaje::where('codigo', '=', $competencia->codigo)->orderBy('codigo', 'asc')->get();
            $res_aprendizaje_array = [];  
            foreach ($res_aprendizaje as $r_a_s){
                $r_a_codigo = $r_a_s->codigo;
                $r_a_descripcion = $r_a_s->descripcion;
                $r_a_activ_form = ActividadFormacion::where('codigo_res_aprendizaje', '=', $r_a_codigo)->orderBy('codigo', 'asc')->get();
                $r_a_indis_logro = IndicadorLogro::where('codigo_res_aprendizaje', '=', $r_a_codigo)->orderBy('codigo', 'asc')->get();
                $actis_form_array = [];
                foreach ($r_a_activ_form as $a_f_s) {
                    $a_f_name = $a_f_s->nombre;
                    $a_f_descripcion = $a_f_s->descripcion;
                    $a_f_array = array("name"=>$a_f_name, "descripcion"=>$a_f_descripcion);
                    array_push($actis_form_array, $a_f_array);
                }
                $indis_logro_array = [];
                foreach ($r_a_indis_logro as $i_l_s) {
                    $i_l_codigo = $i_l_s->codigo;
                    $i_l_descripcion = $i_l_s->descripcion;
                    $i_l_actis_eval = ActividadEvaluacion::where('codigo_indicador_logro', '=', $i_l_codigo)->orderBy('codigo', 'asc')->get();

                    $actis_eval_array = [];
                    foreach ($i_l_actis_eval as $a_e_s) {
                        $a_e_name = $a_e_s->nombre;
                        $a_e_descripcion = $a_e_s->descripcion;
                        $a_e_array = array("name"=>$a_e_name, "descripcion"=>$a_e_descripcion);
                        array_push($actis_eval_array, $a_e_array);
                    }
                    $i_l_array = array("descripcion" => $i_l_descripcion, "actividades_evaluacion" => $actis_eval_array);
                    array_push($indis_logro_array, $i_l_array);
                }

                $r_a_array = array("descripcion" => $r_a_descripcion, "actividades_formacion" => $actis_form_array, "indicadores_logro" => $indis_logro_array);
                array_push($res_aprendizaje_array, $r_a_array);
            }
            $competencia_array = array("codigo_competencia" => $codigo_comp, "descripcion" => $descrip_comp, "resultados_aprendizaje" => $res_aprendizaje_array);
            array_push($competencias_array, $competencia_array);
        }
        $json_response = array("competencias" => $competencias_array);


        return response(json_encode($json_response), 200)
               ->header('Content-Type', 'application/json; charset=utf-8');
    }
}
