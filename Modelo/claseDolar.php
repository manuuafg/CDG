<?php
include_once 'conexion.php';

class Dolar
{
    public $conn;

    public function __construct()
    {
        try {
            $this->conn = Conexion::conectar();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    // Registra el precio en la tabla dolar
    public function insertarPrecio($precio)
    {
        try {
            $query = "INSERT INTO dolar (precio) VALUES (?)";
            $statement = $this->conn->prepare($query);
            $statement->execute([$precio]);
        } catch (PDOException $e) {
            echo "Error al insertar el precio del dólar: " . $e->getMessage();
        }
    }

    // Metodo para llamar el ultimo precio registrado en la tabla dolar
    public function obtenerUltimoPrecioDolar()
    {
        try {
            $query = "SELECT precio FROM dolar ORDER BY fecha_actualizacion DESC LIMIT 1";
            $statement = $this->conn->query($query);
            $resultado = $statement->fetch(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (PDOException $e) {
            echo "Error al obtener el último precio del dólar: " . $e->getMessage();
            return false;
        }
    }

        // Se llaman todos los precios de la tabla para el reporte
    public function obtenerTodosLosPrecios()
    {
        try {
            $query = "SELECT precio, fecha_actualizacion FROM dolar ORDER BY fecha_actualizacion DESC";
            $statement = $this->conn->query($query);
            $precios = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $precios;
        } catch (PDOException $e) {
            echo "Error al obtener todos los precios del dólar: " . $e->getMessage();
            return false;
        }
    }
}
?>
