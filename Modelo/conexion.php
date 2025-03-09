<?php 
//se crea la funcion conectar con PDO que y $con es la variable que guarda la conexion
class conexion{
	public static function conectar(){
		$con = new PDO("mysql: host=localhost; dbname=casa_granos","root","");
		$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		return $con;
	}

}
?>