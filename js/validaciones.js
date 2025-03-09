    function confirmarEliminar() {
        return confirm('¿Estás seguro de que deseas eliminar?');
    }

$(document).ready(function(){
    $("#formulario-producto").submit(function(e){
        var nombre = $("#nombre-producto").val();
        var costo = $("#costo-producto").val();
        var categoria = $("#categoria-producto").val();
        var proveedor = $("#proveedor-producto").val();

        if (nombre === '' || costo === '' || categoria === '' || proveedor === '') {
            window.alert("Por favor, complete todos los campos.");
            e.preventDefault(); 
        }
    });

    $("#formulario-categoria").submit(function(e){
        var nombre = $("#nombre-categoria").val();

        if (nombre === '') {
            window.alert("Por favor, complete el campo.");
            e.preventDefault(); 
        }
    });

    $("#formulario-proveedor").submit(function(e){
        var nombre = $("#nombre-proveedor").val();

        if (nombre === '') {
            window.alert("Por favor, complete el campo.");
            e.preventDefault(); 
        }
    });

    $("#formulario-dolar").submit(function(e){
        var nombre = $("#precio").val();

        if (nombre === '') {
            window.alert("Por favor, complete el campo.");
            e.preventDefault();
        }
    });
});
