const listaTareas = document.querySelector(".lista-tareas");
const contadorTareas = document.querySelector(".encabezado-lista span");
const botonesFiltro = document.querySelectorAll(".filtro");
const buscador = document.querySelector(".buscador-tareas input");

let tareas = JSON.parse(localStorage.getItem("tareas")) || [];
let filtroActual = "Todas";

function mostrarTareas() {
    listaTareas.innerHTML = "";

    let tareasFiltradas = tareas.filter(function(tarea) {
        let coincideCategoria = filtroActual === "Todas" || tarea.categoria === filtroActual;
        let coincideBusqueda = tarea.titulo.toLowerCase().includes(buscador.value.toLowerCase());

        return coincideCategoria && coincideBusqueda;
    });

    contadorTareas.textContent = tareasFiltradas.length === 1 
        ? "1 tarea" 
        : tareasFiltradas.length + " tareas";

    if (tareasFiltradas.length === 0) {
        listaTareas.innerHTML = `
            <div class="sin-tareas-lista">
                <h3>No hay tareas registradas</h3>
                <p>Agrega una nueva tarea para organizar tu día.</p>
            </div>
        `;
        return;
    }

    tareasFiltradas.forEach(function(tarea) {
        let indiceReal = tareas.indexOf(tarea);

        listaTareas.innerHTML += `
            <div class="item-tarea">
                <div class="icono-tarea">📒</div>

                <div class="info-tarea">
                    <h3>${tarea.titulo}</h3>
                    <p class="categoria-texto">● ${tarea.categoria}</p>

                    <div class="detalle-tarea">
                        <span>🕒 ${tarea.hora || "Sin hora"}</span>
                        <span>📅 ${tarea.fecha}</span>
                    </div>
                </div>

                <button class="btn-eliminar" onclick="eliminarTarea(${indiceReal})">
                    Eliminar
                </button>
            </div>
        `;
    });
}

function eliminarTarea(indice) {
    let confirmar = confirm("¿Seguro que quieres eliminar esta tarea?");

    if (confirmar) {
        tareas.splice(indice, 1);
        localStorage.setItem("tareas", JSON.stringify(tareas));
        mostrarTareas();
    }
}

botonesFiltro.forEach(function(boton) {
    boton.addEventListener("click", function() {
        botonesFiltro.forEach(function(b) {
            b.classList.remove("activo");
        });

        boton.classList.add("activo");
        filtroActual = boton.dataset.filtro;
        mostrarTareas();
    });
});

buscador.addEventListener("input", function() {
    mostrarTareas();
});

mostrarTareas();