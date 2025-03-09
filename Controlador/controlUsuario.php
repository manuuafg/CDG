<?php
require_once(__DIR__ . '/../Modelo/conexion.php');
require_once(__DIR__ . '/../Modelo/claseUsuario.php');

class ControlUsuario {
    public function autenticarUsuario($nombre, $password)
    {

        $usuario = new Usuario();
        $usuarioEncontrado = $usuario->buscarUsuario($nombre, $password);

        if ($usuarioEncontrado) {
            $_SESSION['usuario'] = $usuarioEncontrado;
            return true;
        } else {
           
            return false;
        }
    }

    public static function iniciarSesion($nombre, $contrasena) {
        $conexion = Conexion::conectar();
        $query = "SELECT * FROM usuario WHERE nombreU = :nombre AND contrasena = :contrasena";
        $statement = $conexion->prepare($query);
        $statement->bindParam(':nombre', $nombre);
        $statement->bindParam(':contrasena', $contrasena);
        $statement->execute();
        
        $usuario = $statement->fetch(PDO::FETCH_ASSOC);
        
        if ($usuario) {
            session_start();
            $_SESSION['nombreU'] = $usuario['nombreU'];
            return true;
        } else {
            return false;
        }
    
    }

    public static function cerrarSesion() {
        session_start();
        session_unset();
        session_destroy();
        
    }
}
?>
