<?php

namespace proyectDs\Http\Controllers;

use Illuminate\Http\Request;

class DashBoardController extends Controller
{
    public function __construct(){
    	$this->middleware('auth');
    }
    public function index(){
    	return view('aplicacion.dashboard.index');
    }
    public function setDashBoard($type){
    	return view('aplicacion.dashboard.index', ["type"=>$type]);
    }
}
