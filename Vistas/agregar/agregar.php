<?php
// Esto verifica si ha una sesion activa
$varSesion = $_SESSION['nombre']; 
if($varSesion == null || $varSesion == ''){
    header("Location: ../../Vistas/sinAcceso.php");
    die();
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="vistas/login/images/logocorto.ico">
    <title>Agregar Productos</title>
    <link rel="stylesheet" href="vistas/agregar/styles.css">
</head>

<body>
    <!-- Formulario para agregar productos -->
    <form id="formulario-producto" action="?resp=guardar" method="post">
        <input type="hidden" name="id-producto" value="<?php echo $prod->idProducto; ?>"> 
        <fieldset>
            <legend>Información del Producto</legend>
            <div class="input-row">
                <div class="column">
                    <label for="nombre-producto">Nombre:</label>
                    <input type="text" id="nombre-producto" name="nombre-producto" value="<?php echo $prod->nombre; ?>">

                    <label for="costo-producto">Costo:</label>
                    <input type="number" step="0.01" id="costo-producto" name="costo-producto" value="<?php echo $prod->costo; ?>">

                </div>
                <div class="column">
                    <!-- Selector de categoría del producto -->
                    <label for="categoria-producto">Categoría:</label>
                    <select id="categoria-producto" name="categoria-producto" >
                        <?php foreach ($this->MODEL->cargarCategoria() as $k): ?>
                            <option value="<?php echo  $k->idCategoria ?>"<?php echo $k->idCategoria == $prod->idCategoria ? 'selected' :'' ?>><?php echo $k->nombreC ?></option>
                        <?php endforeach; ?>
                    </select>
                    
                    <!-- Selector de proveedor del producto -->
                    <label for="proveedor-producto">Proveedor:</label>
                    <select id="proveedor-producto" name="proveedor-producto">
                        <?php foreach ($this->MODEL->cargarProveedor() as $k): ?>
                            <option value="<?php echo  $k->idProveedor ?>"<?php echo $k->idProveedor == $prod->idProveedor ? 'selected' :'' ?>><?php echo $k->nombreP ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <!-- Botones para enviar el formulario o cancelar -->
            <input type="submit" value="ENVIAR"> <a href="#" onclick="history.back();" class="btn-cancelar">Cancelar</a>
        </fieldset>
    </form>
    <!-- Se incluye los archivos JavaScript -->
    <script src="js/jquery-3.6.0.min.js"></script>
    <script src="js/validaciones.js"></script>
</body>

</html>
