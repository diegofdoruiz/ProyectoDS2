<?php
	namespace proyectDs\Http\Controllers\Strategy;

	use proyectDs\Http\Controllers\UsuarioController;
	
	class UsuarioDirector extends UsuarioController{
		private $algoritmo;
		public function __construct(){
			$this->middleware('auth');
		}
		public function setAlgoritmo($algoritmo){
			$this->algoritmo = $algoritmo;
		}
		public function desplegarFunciones(){
			return $this->algoritmo->funciones();
		}
	}
?>