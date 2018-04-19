<?php
	namespace proyectDs\Http\Controllers\Strategy;

	use proyectDs\Http\Controllers\UsuarioController;
	/*

		Teniendo en cuenta que se modela el modelo de ahorro fijo 10'
		Si se saca 300000 mensual
		cuándo se debe inyectar otros 10'
	*/
	class UsuarioDocente extends UsuarioController{
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