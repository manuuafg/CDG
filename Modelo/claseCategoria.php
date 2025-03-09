<?php
class Categoria {
    public $Conn;

    public function __construct() {
        try {
            $this->Conn = Conexion::conectar();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }


    // Se registra la categoria
    public function guardarCategoria($nombreC) {
        try {
           
            $query = "INSERT INTO categoria (nombreC) VALUES (?)";
            $stmt = $this->Conn->prepare($query);
            $stmt->execute([$nombreC]);
            return true; 
        } catch (Exception $e) {
            die($e->getMessage());
            return false; 
        }
    }

    // Se actuliza la categoria
    public function actualizarCategoria($idCategoria, $nombreC) {
        try {
           
            $query = "UPDATE categoria SET nombreC = ? WHERE idCategoria = ?";
            $stmt = $this->Conn->prepare($query);
            $stmt->execute([$nombreC, $idCategoria]);
            return true; 
        } catch (Exception $e) {
            die($e->getMessage());
            return false; 
        }
    }

    // Se llaman las categorias para el listado
    public function listarCategorias() {
        try {
            $query = "SELECT idCategoria, nombreC FROM categoria";
            $stmt = $this->Conn->query($query);
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function eliminar($id) {
        try {
            $query = "DELETE FROM categoria WHERE idCategoria = ?";
            $stmt = $this->Conn->prepare($query);
            $stmt->execute([$id]);
            return true; 
        } catch (Exception $e) {
            die($e->getMessage());
            return false; 
        }
    }

    public function cargarCategoria($id) {
        try {
            $query = "SELECT idCategoria, nombreC FROM categoria WHERE idCategoria = ?";
            $stmt = $this->Conn->prepare($query);
            $stmt->execute([$id]);
            return $stmt->fetch(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
}
?>
