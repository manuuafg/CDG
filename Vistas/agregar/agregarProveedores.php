<?php
// Esto verifica si hay una sesion activa
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
    <title>Agregar/Editar Proveedor</title>
    <link rel="stylesheet" href="Vistas/agregar/styles.css">
</head>
<body>
    <?php
    // Carga los datos del proveedor si se está editando
    if(isset($_REQUEST['id'])) {
        $prov = $this->MODELPROV->cargarIDProveedor($_REQUEST['id']);
    } else {
        $prov = new Proveedor();
    }
    ?>
    <!-- Formulario para agregar/editar proveedor -->
    <form id="formulario-proveedor" class="proveedores" action="?resps=<?php echo isset($prov->idProveedor) ? 'actualizarP' : 'guardarP'; ?>" method="post">
        <?php if(isset($prov->idProveedor)): ?>
            <input type="hidden" name="id-proveedor" value="<?php echo $prov->idProveedor; ?>">
        <?php endif; ?>
        <fieldset>
            <!-- Título del formulario según si se está editando o agregando un proveedor -->
            <legend><?php echo isset($prov->idProveedor) ? 'Editar proveedor' : 'Agregar proveedor'; ?></legend>
            <div class="input-row">
                <div class="column">
                    <label for="nombre-proveedor">Nombre:</label>
                    <input type="text" id="nombre-proveedor" name="nombre-proveedor" value="<?php echo isset($prov->nombreP) ? $prov->nombreP : ''; ?>" >
                </div>
            </div>
            <!-- Botones para guardar o cancelar la operación -->
            <input type="submit" value="<?php echo isset($prov->idProveedor) ? 'Actualizar' : 'Guardar'; ?>"> <a href="#" onclick="history.back();" class="btn-cancelar">Cancelar</a>
        </fieldset>
    </form>
    <!-- Se incluye los archivos JavaScript -->
    <script src="js/jquery-3.6.0.min.js"></script>
    <script src="js/validaciones.js"></script>
</body>
</html>
