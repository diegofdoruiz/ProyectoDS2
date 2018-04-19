<?php
	namespace proyectDs\Http\Controllers\Strategy;

	use proyectDs\Http\Controllers\Strategy\Algoritmo;
	use proyectDs\Http\Controllers\DashBoardController;
	use Illuminate\Container\Container;

	class FuncionesDirector implements Algoritmo{
		function funciones(){ 
			$container = Container::getInstance();
			$dashboard = $container->make(DashBoardController::class);
			$type = "Director";
			return $dashboard->setDashBoard($type);
		}
	}
?>
