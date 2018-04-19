<?php

//namespace proyectDs\Http\Controllers\Auth;
namespace proyectDs\Http\Controllers;

use proyectDs\Http\Requests;
use Illuminate\Http\Request;
use proyectDs\Http\Requests\LoginFormRequest;
use Illuminate\Container\Container;
use Illuminate\Support\Facades\Auth;
use proyectDs\Http\Controllers\Singleton\LoginSingleton;
use proyectDs\Http\Controllers\Strategy\UsuarioAdministrador;
use proyectDs\Http\Controllers\Strategy\FuncionesAdministrador;
use proyectDs\Http\Controllers\Strategy\UsuarioDecano;
use proyectDs\Http\Controllers\Strategy\FuncionesDecano;
use proyectDs\Http\Controllers\Strategy\UsuarioDirector;
use proyectDs\Http\Controllers\Strategy\FuncionesDirector;
use proyectDs\Http\Controllers\Strategy\UsuarioDocente;
use proyectDs\Http\Controllers\Strategy\FuncionesDocente;
use proyectDs\Http\Controllers\DashBoardController;
use Illuminate\Support\Facades\Redirect;
//use Auth;

class MyLoginController extends Controller
{
    public function __construct(){
        $this->middleware('guest', ['only' => 'showLoginForm']);
    }
    public function showLoginForm(){
        return view('aplicacion.login.index');
    }

    /*Procesar petición POST desde el formulario*/
    public function login(LoginFormRequest $request){
        $credentials = array("email" => $request->get('email'),
                             "password" => $request->get('password'),
                            );
        /*Si se retorna true es porque la sesión es válida y está iniciada*/
        if(Auth::attempt($credentials)){
            return redirect()->route('dashboard'); //Redirección para implemntar estrategia
        }
        return back()
                ->withErrors(['email' => trans('auth.failed')])
                ->withInput(request(['email']));
    }

    public function dashboard(){
        $container = Container::getInstance();
        /*Verificar si hay un sessión abierta*/
        if(auth()->user() != NULL){
            $rol = auth()->user()->rol;
            switch ($rol) {
                case '1':
                    $docente = $container->make(UsuarioDocente::class);
                    $funciones_docente = $container->make(FuncionesDocente::class);
                    $docente->setAlgoritmo($funciones_docente);
                    return $docente->desplegarFunciones();
                    break;
                case '2':
                    $director = $container->make(UsuarioDirector::class);
                    $funciones_director = $container->make(FuncionesDirector::class);
                    $director->setAlgoritmo($funciones_director);
                    return $director->desplegarFunciones();
                    break;
                case '3':
                    $decano = $container->make(UsuarioDecano::class);
                    $funciones_decano = $container->make(FuncionesDecano::class);
                    $decano->setAlgoritmo($funciones_decano);
                    return $decano->desplegarFunciones();
                    break;
                case '4':
                    $administrador = $container->make(UsuarioAdministrador::class);
                    $funciones_administrador = $container->make(FuncionesAdministrador::class);
                    $administrador->setAlgoritmo($funciones_administrador);
                    return $administrador->desplegarFunciones();
                    break;
                default:
                    break;
            }
        }else{
            /*Si no hay sessión, no hay dashboard*/
            return redirect()->route('nologin');
        }
    }

    public function logout(){
        Auth::logout();
        return redirect('login');
    }
}
