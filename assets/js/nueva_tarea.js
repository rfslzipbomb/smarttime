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

formulario.addEventListener("submit", function(evento) {
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

    let tareas = JSON.parse(localStorage.getItem("tareas")) || [];

    tareas.push(nuevaTarea);

    localStorage.setItem("tareas", JSON.stringify(tareas));

    alert("Tarea guardada correctamente");

    window.location.href = "calendario.php";
});