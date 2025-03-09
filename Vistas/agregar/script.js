function agregarFila() {
    const table = document.getElementById('productos-table').getElementsByTagName('tbody')[0];
    const newRow = table.insertRow();
    newRow.innerHTML = `
        <td><input type="text" name="producto[]" required></td>
        <td><input type="number" name="cantidad[]" min="1" required></td>
        <td><input type="number" name="precio[]" step="0.01" required></td>
        <td><span class="total">$0.00</span></td>
        <td><button type="button" onclick="eliminarFila(this)">Eliminar</button></td>
    `;
}

function eliminarFila(button) {
    const row = button.parentNode.parentNode;
    row.parentNode.removeChild(row);
    calcularTotalFinal();
}

function calcularTotal() {
    const table = document.getElementById('productos-table');
    const rows = table.getElementsByTagName('tbody')[0].getElementsByTagName('tr');
    let totalFinal = 0;

    for (let i = 0; i < rows.length; i++) {
        const cantidad = rows[i].getElementsByTagName('input')[1].value;
        const precio = rows[i].getElementsByTagName('input')[2].value;
        const total = cantidad * precio;
        rows[i].getElementsByClassName('total')[0].innerText = `$${total.toFixed(2)}`;
        totalFinal += total;
    }

    document.getElementById('total-final').innerText = `$${totalFinal.toFixed(2)}`;
}

document.getElementById('productos-table').addEventListener('input', calcularTotal);

function guardarNota() {
    const cliente = document.getElementById('cliente').value;
    const fecha = document.getElementById('fecha').value;

    if (cliente && fecha) {
        alert('Nota de entrega guardada');
    } else {
        alert('Por favor, complete todos los campos requeridos');
    }
}
