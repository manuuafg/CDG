<?php
require_once(__DIR__ . '/../Modelo/conexion.php');
require_once(__DIR__ . '/../Modelo/claseDolar.php');

class ControlDolar {
    private $dolarModelo;

    public function dolar(){
        include_once 'vistas/cambiodolar/cambiodolar.php';
    }

    public function __construct() {
        $this->dolarModelo = new Dolar();
    }

    public function index() {
        include_once 'vistas/login/login.php';        
    }

    public function guardarPrecio() {
        if(isset($_POST['precio'])) {
            $precio = $_POST['precio'];
            $this->dolarModelo->insertarPrecio($precio);
            header("Location: index.php");
            exit(); 
        } else {
           
            if(isset($_SERVER['HTTP_REFERER']) && strpos($_SERVER['HTTP_REFERER'], 'listadoProductos.php') !== false) {
                echo "No se proporcionó ningún precio.";
            }
        }
    }

    public function obtenerUltimoPrecioDolar() {
        return $this->dolarModelo->obtenerUltimoPrecioDolar();
    }
}

$controlDolar = new ControlDolar();
$controlDolar->guardarPrecio();
