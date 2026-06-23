const listaTareas = document.querySelector(".lista-tareas");
const contadorTareas = document.querySelector(".encabezado-lista span");
const botonesFiltro = document.querySelectorAll(".filtro");
const buscador = document.querySelector(".buscador-tareas input");

// Elementos del Modal
const modalTarea = document.getElementById("modal-tarea");
const btnCerrarModal = document.querySelector(".btn-cerrar-modal");
const modalContenido = document.getElementById("modal-contenido-detalle");

let tareas = []; 
let filtroActual = "Todas";

async function cargarTareas() {
    try {
        const respuesta = await fetch("php/obtener_tareas.php");
        const resultado = await respuesta.json();

        if (resultado.success) {
            tareas = resultado.tareas; 
            mostrarTareas(); 
        } else {
            console.error("Error al cargar tareas:", resultado.message);
        }
    } catch (error) {
        console.error("Error de conexión:", error);
    }
}

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
        // 1. Verificamos el estado para saber si la dibujamos tachada/marcada
        let checked = tarea.estado === 'completada' ? 'checked' : '';
        let estiloTachado = tarea.estado === 'completada' ? 'opacity: 0.6; text-decoration: line-through;' : '';

        listaTareas.innerHTML += `
            <div class="item-tarea" style="cursor: pointer; transition: all 0.3s ease; ${estiloTachado}" onclick="verDetalleTarea(${tarea.id})">
                
                <div style="margin-right: 15px; display: flex; align-items: center;" onclick="event.stopPropagation();">
                    <input type="checkbox" ${checked} onchange="cambiarEstado(${tarea.id}, 'tarea', this)" style="width: 22px; height: 22px; cursor: pointer;">
                </div>

                <div class="icono-tarea">📒</div>

                <div class="info-tarea">
                    <h3>${tarea.titulo}</h3>
                    <p class="categoria-texto">● ${tarea.categoria}</p>

                    <div class="detalle-tarea">
                        <span>🕒 ${tarea.hora || "Sin hora"}</span>
                        <span>📅 ${tarea.fecha}</span>
                    </div>
                </div>

                <button class="btn-eliminar" onclick="event.stopPropagation(); eliminarTarea(${tarea.id})">
                    Eliminar
                </button>
            </div>
        `;
    });
}

// NUEVA FUNCIÓN: Abre la tarjeta ampliada buscando los datos locales ya descargados
function verDetalleTarea(idTarea) {
    const tarea = tareas.find(t => t.id === idTarea);
    if (!tarea) return;

    // Inyectamos la información estructurada dentro del modal
    modalContenido.innerHTML = `
        <div class="modal-detalles-info">
            <h2>${tarea.titulo}</h2>
            <p class="categoria-texto" style="margin-top: 5px;">● ${tarea.categoria}</p>
            
            <div class="meta-item">
                <span><strong>📅 Fecha:</strong> ${tarea.fecha}</span>
                <span><strong>🕒 Hora:</strong> ${tarea.hora || "Sin hora asignada"}</span>
            </div>
            
            <div class="descripcion-bloque">
                <strong>Descripción:</strong>
                <p style="margin-top: 8px;">${tarea.descripcion ? tarea.descripcion : "<i>Sin detalles adicionales.</i>"}</p>
            </div>
        </div>
    `;

    // Mostramos el modal cambiando el display a flex
    modalTarea.style.display = "flex";
}

// NUEVA FUNCIÓN: Oculta el modal
function cerrarModal() {
    modalTarea.style.display = "none";
}

// Eventos para cerrar el modal de forma intuitiva
btnCerrarModal.addEventListener("click", cerrarModal);

// Cerrar si hacen clic fuera de la tarjeta blanca (en el fondo oscuro)
window.addEventListener("click", function(event) {
    if (event.target === modalTarea) {
        cerrarModal();
    }
});

async function eliminarTarea(idTarea) {
    let confirmar = confirm("¿Seguro que quieres eliminar esta tarea?");

    if (confirmar) {
        try {
            const respuesta = await fetch("php/eliminar_tarea.php", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json"
                },
                body: JSON.stringify({ id: idTarea }) 
            });

            const resultado = await respuesta.json();

            if (resultado.success) {
                cargarTareas(); 
            } else {
                alert("Error al eliminar la tarea: " + resultado.message);
            }
        } catch (error) {
            console.error("Error en la comunicación con el servidor:", error);
            alert("Hubo un problema de conexión al intentar eliminar.");
        }
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


cargarTareas();

// =========================================================
// FUNCIÓN PARA CHECKLIST: Cambiar estado (Pendiente/Completada)
// =========================================================
async function cambiarEstado(id, tipo, checkboxElement) {
    const nuevoEstado = checkboxElement.checked ? 'completada' : 'pendiente';
    
    // Buscamos el contenedor principal de la lista de tareas
    const tarjeta = checkboxElement.closest('.item-tarea'); 

    try {
        const respuesta = await fetch("php/toggle_estado.php", {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify({ id: id, tipo: tipo, estado: nuevoEstado })
        });

        const resultado = await respuesta.json();

        if (resultado.success) {
            // Efecto visual instantáneo
            if (nuevoEstado === 'completada') {
                tarjeta.style.opacity = '0.6';
                tarjeta.style.textDecoration = 'line-through';
            } else {
                tarjeta.style.opacity = '1';
                tarjeta.style.textDecoration = 'none';
            }
            
            // Actualizamos la memoria local (tu arreglo global se llama 'tareas' aquí)
            let t = tareas.find(x => x.id === id);
            if (t) t.estado = nuevoEstado;
            
        } else {
            alert("Error al actualizar: " + resultado.message);
            checkboxElement.checked = !checkboxElement.checked; // Regresar la cajita a como estaba
        }
    } catch (error) {
        console.error("Error al cambiar estado:", error);
        alert("Hubo un problema de conexión al intentar actualizar.");
        checkboxElement.checked = !checkboxElement.checked; 
    }
}