<?php
class Usuario
{
    public $Conn;

    public $nombre;
    public $pass;

    public function __construct()
    {
        try {
            $this->Conn = conexion::conectar();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    // Se hace la consulta en la base de datos de la tabla llamada usuario
    public function buscarUsuario($nombre, $contrasena)
    {
        try {
            $query = "SELECT * FROM usuario WHERE nombreU = ? AND contrasena = ?";
            $resultado = $this->Conn->prepare($query);
            $resultado->execute(array($nombre, $contrasena));
            return $resultado->fetch(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
}
