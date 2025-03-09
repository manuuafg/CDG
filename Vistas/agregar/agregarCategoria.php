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
    <title>Agregar/Editar Categoría</title>
    <link rel="stylesheet" href="Vistas/agregar/styles.css">
</head>

<body>
    <!-- Formulario para agregar/editar categoría -->
    <form id="formulario-categoria" class="categoria" action="?respc=<?php echo isset($cat->idCategoria) ? 'actualizarC' : 'guardarC'; ?>" method="post">
        <?php if(isset($cat->idCategoria)): ?>
            <input type="hidden" name="id-categoria" value="<?php echo $cat->idCategoria; ?>">
        <?php endif; ?>
        <fieldset>
            <!-- Título del formulario según si se está editando o agregando una categoría -->
            <legend><?php echo isset($cat->idCategoria) ? 'Editar categoría' : 'Agregar categoría'; ?></legend>
            <div class="input-row">
                <div class="column">
                    <label for="nombre-categoria">Nombre:</label>
                    <input type="text" id="nombre-categoria" name="nombre-categoria" value="<?php echo isset($cat->nombreC) ? $cat->nombreC : ''; ?>">
                </div>
            </div>
            <!-- Botones para guardar o cancelar la operación -->
            <input type="submit" value="<?php echo isset($cat->idCategoria) ? 'Actualizar' : 'Guardar'; ?>"> <a href="#" onclick="history.back();" class="btn-cancelar">Cancelar</a>
        </fieldset>
    </form>
    <!-- Se incluye los archivos JavaScript -->
    <script src="js/jquery-3.6.0.min.js"></script>
    <script src="js/validaciones.js"></script>
</body>

</html>
