<?php
class Producto
{
    public $Conn;

    public $idProducto;
    public $nombre;
    public $costo;
    public $pvp;
    public $idProveedor;
    public $idCategoria;

   
    public function __construct()
    {
        try {
            $this->Conn = conexion::conectar();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function listar($categoria = null)
    {
        try {
            
            $query = "SELECT p.idProducto, p.nombre, p.pvp, p.costo, e.nombreP, c.nombreC FROM producto p INNER JOIN proveedor e on p.idProveedor = e.idProveedor INNER JOIN categoria c on p.idCategoria = c.idCategoria";
    
           
            if ($categoria !== null && $categoria !== '') {
                
                $query .= " WHERE p.idCategoria = ?";
            }
    
      
            $resultado = $this->Conn->prepare($query);
    
            
            if ($categoria !== null && $categoria !== '') {
                $resultado->execute([$categoria]);
            } else {
                
                $resultado->execute();
            }
    
          
            return $resultado->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            
            die($e->getMessage());
        }
    }

    // Hace la consulta en la tabla categoria
    public function listarCategorias()
{
    try {
        $query = "SELECT * FROM categoria";
        $resultado = $this->Conn->prepare($query);
        $resultado->execute();
        return $resultado->fetchAll(PDO::FETCH_OBJ);
    } catch (Exception $e) {
        die($e->getMessage());
    }
}
    

    public function cargarProveedor()
    {
        try {
            $query = "SELECT * from proveedor";
            $resultado = $this->Conn->prepare($query);
            $resultado->execute();
            return $resultado->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function cargarCategoria()
    {
        try {
            $query = "SELECT * from categoria";
            $resultado = $this->Conn->prepare($query);
            $resultado->execute();
            return $resultado->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function cargarID($id)
    {
        try {
            $query = "SELECT * from producto where idProducto=?";
            $resultado = $this->Conn->prepare($query);
            $resultado->execute(array($id));
            return $resultado->fetch(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    // Calcula el pvp dependiendo del costo e ingresa todos los datos en la tabla producto
    public function registrar($data)
    {
        try {
            $data-> pvp = $data->costo/0.7;
            $query = "Insert into producto (nombre,pvp,costo,idProveedor,idCategoria)values(?,?,?,?,?)";
            $this->Conn->prepare($query)->execute(array($data->nombre, $data->pvp, $data->costo, $data->idProveedor, $data->idCategoria));
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    // Calcula el pvp dependiendo del costo y actualiza todos los datos en la tabla producto
    public function actualizarDatos($data)
    {
        try {
            $data-> pvp = $data->costo/0.7;
            $query = "UPDATE producto set nombre=?,pvp=?,costo=?,idProveedor=?,idCategoria=? WHERE idProducto=?";
            $this->Conn->prepare($query)->execute(array($data->nombre, $data->pvp, $data->costo, $data->idProveedor, $data->idCategoria, $data->idProducto));
        } catch (Exception $e) {
            die($e->getMessage());
        }

    }

    public function eliminar($id)
    {
        try {
            $query = "Delete from producto where idProducto =?";
            $resultado = $this->Conn->prepare($query);
            $resultado->execute(array($id));
        } catch (Exception $e) {
            die($e->getMessage());
        }

    }

}
