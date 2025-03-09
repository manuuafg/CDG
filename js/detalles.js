$(document).ready(function() {
    $('#categoriasTable').DataTable({
        "language": {
            "url": "//cdn.datatables.net/plug-ins/2.2.2/i18n/es-ES.json"
        },
        "columnDefs": [
            { "type": "num", "targets": 0 },
            {
            "orderable": false, 
            "targets": 2 
        }]
    });

    function normalizarMoneda(valor) {
        return parseFloat(valor.replace('Bs.', '').replace(',', '.'));
    }

    $('#productosTable').DataTable({
        "language": {
            "url": "//cdn.datatables.net/plug-ins/2.2.2/i18n/es-ES.json"
        },
        "columnDefs": [
            { "type": "num", "targets": 0 }, 
            { "type": "num-fmt", "targets": [4, 5] }, 
            { 
                "type": "currency", 
                "targets": 6,
                "render": function(data, type, row) {
                    if (type === 'sort' || type === 'type') {
                        return normalizarMoneda(data); 
                    }
                    return data; 
                }
            }, 
            { "orderable": false, "targets": 7 } 
        ]
    });


    $('#proveedoresTable').DataTable({
        "language": {
            "url": "//cdn.datatables.net/plug-ins/2.2.2/i18n/es-ES.json"
        },
        "columnDefs": [
            { "type": "num", "targets": 0 }, 
            {
            "orderable": false, 
            "targets": 2 
        }]
    });
});