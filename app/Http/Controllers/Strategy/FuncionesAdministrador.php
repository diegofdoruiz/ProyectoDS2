<?php
	namespace proyectDs\Http\Controllers\Strategy;

	use proyectDs\Http\Controllers\Strategy\Algoritmo;
	use proyectDs\Http\Controllers\DashBoardController;
	use Illuminate\Container\Container;

	class FuncionesAdministrador implements Algoritmo{
		function funciones(){ 
			$container = Container::getInstance();
			$dashboard = $container->make(DashBoardController::class);
			$type = "Administrador";
			return $dashboard->setDashBoard($type);
		}
	}
?>