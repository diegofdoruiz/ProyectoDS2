<?php
namespace proyectDs\Http\Controllers\Singleton;


class LoginSingleton{	
	private static $instance;
	function __construct(){

	}
	public static function getInstance(){
		if(!self::$instance){
			self::$instance = new static();
		}
		return self::$instance;
	}

	public function set($key, $value){
		$this->$key = $value;
	}

	public function get($key){
		return $this->$key;
	}
	
	public function getArrayObject(){
		return (array)$this;
	}
}

?>