<?php
	namespace proyectDs\Http\Controllers\Strategy;

	use proyectDs\Http\Controllers\Strategy\Algoritmo;
	use proyectDs\Http\Controllers\DashBoardController;
	use Illuminate\Container\Container;

	class FuncionesDecano implements Algoritmo{
		function funciones(){ 
			$container = Container::getInstance();
			$dashboard = $container->make(DashBoardController::class);
			$type = "Decano";
			return $dashboard->setDashBoard($type);
		}
	}
?>
