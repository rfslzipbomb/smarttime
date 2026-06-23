document.getElementById('form-evento').addEventListener('submit', async function(e) {
    e.preventDefault();

    const data = {
        titulo: document.getElementById('titulo').value,
        tipo: document.getElementById('tipo').value,
        ubicacion: document.getElementById('ubicacion').value,
        vestimenta: document.getElementById('vestimenta').value,
        fecha: document.getElementById('fecha').value,
        hora_inicio: document.getElementById('hora_inicio').value,
        hora_fin: document.getElementById('hora_fin').value,
        detalles: document.getElementById('detalles').value
    };

    try {
        const res = await fetch('php/crear_evento.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(data)
        });
        const resultado = await respuesta.json();

        if (resultado.success) {
            alert("Tarea guardada correctamente");
            window.location.href = "calendario.php"; 
        } else if (resultado.es_conflicto) {
            // Si el servidor detectó un conflicto, disparamos el modal
            document.getElementById('texto-conflicto').innerHTML = resultado.message + "<br><br>Por favor, selecciona otra hora o fecha.";
            document.getElementById('modal-conflicto').style.display = 'flex';
        } else {
            alert("Error al guardar: " + resultado.message);
        }
    } catch (error) {
        console.error('Error:', error);
    }
});