<?php

namespace proyectDs\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct(){

    }
    public function index(Request $request){
    	if($request){
		    return view('aplicacion.home.index');
    	}
    }
}
