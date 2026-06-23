const botonesCategoria = document.querySelectorAll(".categoria");
let categoriaSeleccionada = "Trabajo";

botonesCategoria.forEach(function(boton) {
    boton.addEventListener("click", function() {
        botonesCategoria.forEach(function(b) {
            b.classList.remove("activa");
        });

        boton.classList.add("activa");
        categoriaSeleccionada = boton.dataset.categoria;
    });
});

const formulario = document.getElementById("form-tarea");

// Agregamos 'async' para poder usar 'await' en la petición fetch
formulario.addEventListener("submit", async function(evento) {
    evento.preventDefault();

    const titulo = document.getElementById("titulo").value;
    const fecha = document.getElementById("fecha").value;
    const hora = document.getElementById("hora").value;
    const descripcion = document.getElementById("descripcion").value;

    const nuevaTarea = {
        titulo: titulo,
        categoria: categoriaSeleccionada,
        fecha: fecha,
        hora: hora,
        descripcion: descripcion
    };

    try {
        // En lugar de localStorage, enviamos los datos al servidor PHP
        const respuesta = await fetch("php/crear_tarea.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify(nuevaTarea)
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
        console.error("Error en la comunicación con el servidor:", error);
        alert("Hubo un problema de conexión.");
    }
});