<?php 
class Proveedor{
    public $Conc;

    public $idProveedor;
    public $nombreProveedor;

    public function __construct()
    {
        try {
            $this->Conc = conexion::conectar();
        } catch (Exception $e) {
            die($e->getMessage());
        }
        if (!$this->Conc) {
            die("Error al establecer la conexión.");
        }
    }
    // se hace la consulta en la base de datos de la tabla proveedor 
    public function listarProveedores() {
        try {
            $query = "SELECT idProveedor, nombreP FROM proveedor"; 
            $stmt = $this->Conc->query($query);
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    

    public function cargarIDProveedor($id) {
        try {
            $query = "SELECT * FROM proveedor WHERE idProveedor=?";
            $resultado = $this->Conc->prepare($query);
            $resultado->execute(array($id));
            return $resultado->fetch(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    // Hace el registro del proveedor en nuestra base de datos en la tabla proveedor
    public function registrarProveedor($datos) { 
        try {
            $query = "INSERT INTO proveedor (nombreP) VALUES (?)";
            $this->Conc->prepare($query)->execute(array($datos->nombreProveedor));
        } catch (Exception $e) { 
            die($e->getMessage());
        }
    }

    // Se encarga de reemplazar los datos previamente cargados
    public function actualizarProveedor($datos){
        try {
            $query = "UPDATE proveedor SET nombreP=? WHERE idProveedor=?";
            $this->Conc->prepare($query)->execute(array($datos->nombreProveedor, $datos->idProveedor));
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    
    
    public function eliminarProveedor($id){
        try {
            $query = "DELETE FROM proveedor WHERE idProveedor=?";
            $resultado = $this->Conc->prepare($query);
            $resultado->execute(array($id));
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
}
?>
