<?php
include_once 'Modelo/ClaseProveedor.php'; 

class controlProveedor {
    public $MODELPROV;

    public function __construct() {
        $this->MODELPROV = new Proveedor();
    }

    public function index()
    {
		include_once 'vistas/login/login.php';        
    }

    public function proveedor() {
        $proveedores = $this->MODELPROV->listarProveedores();
        if(isset($_REQUEST['id'])) {
            $prov = $this->MODELPROV->cargarIDProveedor($_REQUEST['id']);
        }
        include_once 'Vistas/listados/listadoProveedor.php';
    }

    function registrarProveedor() {
        include 'Vistas/agregar/agregarProveedores.php';
    }
    
    public function guardarP(){
        $prov = new Proveedor();
        $prov->nombreProveedor = $_POST['nombre-proveedor'];
        $this->MODELPROV->registrarProveedor($prov);
        header("Location: index.php?resps=proveedor");
    }

    function actualizarProveedor(){
        include 'Vistas/agregar/agregarProveedores.php';
    }

    public function actualizarP() {
        $prov = new Proveedor();
        $prov->idProveedor = $_POST['id-proveedor'];
        $prov->nombreProveedor = $_POST['nombre-proveedor'];
        try {
            $this->MODELPROV->actualizarProveedor($prov);
        } catch (Exception $e) {
            die($e->getMessage());
        }
        header("Location: index.php?resps=proveedor");
    }

    public function eliminarProveedor(){
        $this->MODELPROV->eliminarProveedor($_REQUEST['id']);
        header("Location: index.php?resps=proveedor");
    }
}
?>
