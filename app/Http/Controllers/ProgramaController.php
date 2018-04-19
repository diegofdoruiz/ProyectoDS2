<?php

namespace proyectDs\Http\Controllers;

use Illuminate\Http\Request;
use proyectDs\Http\Requests;
use proyectDs\Programa;
use Illuminate\Support\Facades\Redirect;
use proyectDs\Http\Requests\ProgramaFormRequest;
use BD;

class ProgramaController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    public function index(Request $request){
        if(auth()->user()->rol == '1'){
            return redirect('dashboard');
        }
        $codigo_usuario = auth()->user()->codigo;
    	if($request){
    		$query=trim($request->get('searchText'));
            if(auth()->user()->rol == '2'){
                /*Se muestra solo se muestra su programa académico o el programa del cua es director*/
                $programas=\DB::table('programa')
                    ->where([['codigo','=',$query],['estado','=','1'], ['director','=',$codigo_usuario]])
                    ->orwhere([['nombre','LIKE','%'.$query.'%'], ['estado','=','1'], ['director','=',$codigo_usuario]])
                    ->orderBy('codigo', 'desc')
                    ->paginate(7);
    		    return view('aplicacion.programa.index', ["programas"=>$programas, "searchText"=>$query]);
            }else if(auth()->user()->rol == '3'){
                /*Se hacen los JOIN para que un Decano vea todos los programas de su facultad*/
                $programas=\DB::table('facultad')
                    ->join('escuela', 'facultad.codigo', '=', 'escuela.codigo_facultad')
                    ->join('programa', 'escuela.codigo', '=', 'programa.codigo_escuela')
                    ->where([['programa.codigo','=',$query], ['facultad.director','=', $codigo_usuario], ['programa.estado', '=', '1']])
                    ->orwhere([['programa.nombre','LIKE','%'.$query.'%'], ['facultad.director','=', $codigo_usuario], ['programa.estado', '=', '1']])
                    ->orderBy('programa.codigo', 'desc')
                    ->paginate(7);
                return view('aplicacion.programa.index', ["programas"=>$programas, "searchText"=>$query]);
            }else if(auth()->user()->rol == '4'){
                /*El administrador puede ver todos los programas activos*/
                $programas=\DB::table('programa')
                    ->where([['codigo','=',$query],['estado','=','1']])
                    ->orwhere([['nombre','LIKE','%'.$query.'%'], ['estado','=','1']])
                    ->orderBy('codigo', 'desc')
                    ->paginate(7);
                return view('aplicacion.programa.index', ["programas"=>$programas, "searchText"=>$query]);
            }else{
                return redirect('dashboard');
            }
    	}
    }
    public function create(){
    	$escuelas = \DB::table('escuela')->where('estado', '=', '1')->get();
        $directores = \DB::table('usuario')->where([['rol','=', '2'],['estado','=','1']])->get();
    	return view("aplicacion.programa.create", ["escuelas"=>$escuelas, "directores"=>$directores]);
    }
    public function store(ProgramaFormRequest $request){
		$programa = new Programa;
		$programa->codigo=$request->get('codigo');
		$programa->nombre=$request->get('nombre');
		$programa->num_semestres=$request->get('semestres');
		$programa->creditos=$request->get('creditos');
		$programa->codigo_escuela=$request->get('escuela');
        $programa->director=$request->get('director');
		$programa->estado='1';
		$programa->save();
		return Redirect::to('programa');
    }
    public function show($codigo){
    	return view("aplicacion.programa.show", ["programa"=>Programa::findOrFail($codigo)]);
    }
    public function edit($codigo){
    	$escuelas = \DB::table('escuela')->where('estado', '=', '1')->get();
        $directores = \DB::table('usuario')->where([['rol','=','2'],['estado','=','1']])->get();
    	return view("aplicacion.programa.edit", ["programa"=>Programa::findOrFail($codigo)], ["escuelas"=>$escuelas, "directores"=>$directores]);
    }
    public function update(ProgramaFormRequest $request, $codigo){
    	$programa=Programa::findOrFail($codigo);
    	//$programa->codigo=$request->get('codigo');
		$programa->nombre=$request->get('nombre');
		$programa->num_semestres=$request->get('semestres');
		$programa->creditos=$request->get('creditos');
		$programa->codigo_escuela=$request->get('escuela');
        $programa->codigo_escuela=$request->get('escuela');
		$programa->director=$request->get('director');
    	$programa->update();
    	return Redirect::to('programa');
    }
    public function destroy($codigo){
    	$programa=Programa::findOrFail($codigo);
    	$programa->estado='0';
    	$programa->update();
    	return Redirect::to('programa');
    }
}
