<?php
include_once 'Modelo/claseCategoria.php';

class controlCategoria {
    public $MODEL;

    public function __construct() {
        $this->MODEL = new Categoria();
    }

    public function index()
    {
		include_once 'vistas/login/login.php';        
    }

    public function categoria() {
        $categorias = $this->MODEL->listarCategorias();
        if(isset($_REQUEST['id'])) {
            $cat = $this->MODEL->cargarCategoria($_REQUEST['id']); 
        }
        include_once 'Vistas/listados/listadoCategorias.php';
    }

    public function eliminarC() {
        $idCategoria = $_GET['id'];
        $this->MODEL->eliminar($idCategoria);
        header("Location: index.php?respc=categoria");
        exit();
    }

    public function categoriaC() {
        if(isset($_REQUEST['id'])) {
            $cat = $this->MODEL->cargarCategoria($_REQUEST['id']); 
        }
        include_once 'Vistas/agregar/agregarCategoria.php';
    }
    
	public function nuevoC() {
		if(isset($_REQUEST['id'])) {
			$categoria = $this->MODEL->cargarCategoria($_REQUEST['id']);
			if ($categoria) {
				$cat = new Categoria(); 
				$cat->idCategoria = $categoria->idCategoria;
				$cat->nombreC = $categoria->nombreC;
			} else {
				header("Location: error.php");
				exit();
			}
		}
		include_once 'Vistas/agregar/agregarCategoria.php';
	}

    public function guardarC() {
        $nombreCategoria = $_POST['nombre-categoria'];
        $this->MODEL->guardarCategoria($nombreCategoria);
        $this->retrocederDosPaginas();
    }
    
    public function retrocederDosPaginas() {
        echo "<script>window.history.go(-2);</script>";
        exit;
    }
   
    
    public function actualizarC() {
        $idCategoria = $_POST['id-categoria'];
        $nombreCategoria = $_POST['nombre-categoria'];
        $this->MODEL->actualizarCategoria($idCategoria, $nombreCategoria);
        $this->retrocederDosPaginas();
    }
   
}
?>
