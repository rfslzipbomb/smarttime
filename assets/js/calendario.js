let fechaActual = new Date();
let diaSeleccionado = null;

// Nuevos arreglos globales para guardar los datos de SQLite
let listaTareas = [];
let listaEventos = [];

const meses = [
    "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio",
    "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"
];

// 1. NUEVA FUNCIÓN: Descargar datos de la base de datos al inicio
async function cargarAgenda() {
    try {
        const respuesta = await fetch("php/obtener_agenda.php");
        const resultado = await respuesta.json();
        
        if (resultado.success) {
            listaTareas = resultado.tareas;
            listaEventos = resultado.eventos;
            
            crearCalendario(); // Dibujamos el calendario una vez que tenemos los datos
            
            // Opcional: Seleccionar automáticamente el día de hoy al cargar
            seleccionarHoy();
        } else {
            console.error("Error al cargar la agenda:", resultado.message);
        }
    } catch (error) {
        console.error("Error de conexión:", error);
    }
}

// Función auxiliar para seleccionar el día actual por defecto
function seleccionarHoy() {
    let hoy = new Date();
    let anio = hoy.getFullYear();
    let mes = hoy.getMonth();
    let dia = hoy.getDate();
    
    // Solo seleccionamos si estamos viendo el mes y año actual
    if (fechaActual.getFullYear() === anio && fechaActual.getMonth() === mes) {
        let mesFormato = String(mes + 1).padStart(2, "0");
        let diaFormato = String(dia).padStart(2, "0");
        diaSeleccionado = `${anio}-${mesFormato}-${diaFormato}`;
        mostrarActividadesDelDia(diaSeleccionado);
        crearCalendario(); // Redibujar para marcar la selección
    }
}

function crearCalendario() {
    const mes = fechaActual.getMonth();
    const anio = fechaActual.getFullYear();

    const titulo = document.getElementById("mes-anio");
    const contenedorDias = document.getElementById("dias-calendario");

    titulo.textContent = `${meses[mes]} ${anio}`;
    contenedorDias.innerHTML = "";

    const primerDia = new Date(anio, mes, 1).getDay();
    const ultimoDiaMes = new Date(anio, mes + 1, 0).getDate();
    const ultimoDiaMesAnterior = new Date(anio, mes, 0).getDate();

    // Días del mes anterior (grises)
    for (let i = primerDia; i > 0; i--) {
        const dia = document.createElement("span");
        dia.textContent = ultimoDiaMesAnterior - i + 1;
        dia.classList.add("gris");
        contenedorDias.appendChild(dia);
    }

    // Días del mes actual
    for (let i = 1; i <= ultimoDiaMes; i++) {
        const dia = document.createElement("span");
        
        // Formatear fecha para comparar
        let mesFormato = String(mes + 1).padStart(2, "0");
        let diaFormato = String(i).padStart(2, "0");
        let fechaStr = `${anio}-${mesFormato}-${diaFormato}`;

        // Estructura interna del día para soportar los puntitos
        dia.style.display = "flex";
        dia.style.flexDirection = "column";
        dia.style.justifyContent = "center";
        dia.style.alignItems = "center";

        let htmlInterno = `${i}`;

        // Revisar si hay tareas o eventos para este día
        const tieneTarea = listaTareas.some(t => t.fecha === fechaStr);
        const tieneEvento = listaEventos.some(e => e.fecha === fechaStr);

        // Si hay actividades, agregamos los puntitos indicadores debajo del número
        if (tieneTarea || tieneEvento) {
            let indicadoresHTML = `<div style="display: flex; gap: 4px; margin-top: 3px;">`;
            if (tieneTarea) indicadoresHTML += `<div style="width: 5px; height: 5px; border-radius: 50%; background-color: var(--color-principal);"></div>`;
            if (tieneEvento) indicadoresHTML += `<div style="width: 5px; height: 5px; border-radius: 50%; background-color: #f59e0b;"></div>`;
            indicadoresHTML += `</div>`;
            htmlInterno += indicadoresHTML;
        }

        dia.innerHTML = htmlInterno;

        // Mantener la clase 'seleccionado' si el usuario navega entre meses y vuelve
        if (diaSeleccionado === fechaStr) {
            dia.classList.add("seleccionado");
        }

        dia.onclick = function () {
            seleccionarDia(dia, i, mes, anio);
        };

        contenedorDias.appendChild(dia);
    }

    // Días del mes siguiente (grises) para completar 42 celdas
    const totalCeldas = primerDia + ultimoDiaMes;
    const diasSiguientes = 42 - totalCeldas;

    for (let i = 1; i <= diasSiguientes; i++) {
        const dia = document.createElement("span");
        dia.textContent = i;
        dia.classList.add("gris");
        contenedorDias.appendChild(dia);
    }
}

function cambiarMes(valor) {
    fechaActual.setMonth(fechaActual.getMonth() + valor);
    crearCalendario();
}

function seleccionarDia(elemento, dia, mes, anio) {
    const dias = document.querySelectorAll(".dias span");
    dias.forEach(d => d.classList.remove("seleccionado"));

    elemento.classList.add("seleccionado");

    let mesFormato = String(mes + 1).padStart(2, "0");
    let diaFormato = String(dia).padStart(2, "0");

    diaSeleccionado = `${anio}-${mesFormato}-${diaFormato}`;

    // Cambiamos el nombre de la función porque ahora muestra tareas y eventos
    mostrarActividadesDelDia(diaSeleccionado);
}

// 2. FUNCIÓN ACTUALIZADA: Mezcla tareas y eventos desde los arreglos globales
function mostrarActividadesDelDia(fechaSeleccionada) {
    const contenedor = document.getElementById("contenedor-tareas");
    const contador = document.getElementById("contador-tareas");

    let tareasFiltradas = listaTareas.filter(t => t.fecha === fechaSeleccionada);
    let eventosFiltrados = listaEventos.filter(e => e.fecha === fechaSeleccionada);
    let totalActividades = tareasFiltradas.length + eventosFiltrados.length;

    contador.textContent = totalActividades === 1 ? "1 Actividad" : totalActividades + " Actividades";

    if (totalActividades === 0) {
        contenedor.innerHTML = `
            <div class="sin-tareas">
                <div class="imagen-tarea">📋</div>
                <h3>Día libre</h3>
                <p>No tienes actividades para este día.</p>
                <div style="display:flex; gap:10px; justify-content:center; margin-top: 15px;">
                    <a href="nueva_tarea.php" class="btn-agregar" style="background:var(--color-principal); color:#fff; text-decoration:none; padding:10px 15px; border-radius:8px;">+ Tarea</a>
                    <a href="nuevo_evento.php" class="btn-agregar" style="background:#f59e0b; color:#fff; text-decoration:none; padding:10px 15px; border-radius:8px;">+ Evento</a>
                </div>
            </div>
        `;
    } else {
        contenedor.innerHTML = "";

        // PINTAR EVENTOS (CON BOTÓN ELIMINAR)
        eventosFiltrados.forEach(function(evento) {
            contenedor.innerHTML += `
                <div class="tarjeta-tarea" style="background: #fffbeb; border-left: 4px solid #f59e0b; position: relative;">
                    <h4 style="color: #d97706; display:flex; justify-content:space-between;">
                        🎉 ${evento.titulo} <small style="font-size:11px; color:#92400e; font-weight:normal;">${evento.tipo}</small>
                    </h4>
                    <p style="margin-top: 8px;"><strong>🕒 Horario:</strong> ${evento.hora_inicio || 'Día completo'} ${evento.hora_fin ? ' - ' + evento.hora_fin : ''}</p>
                    ${evento.ubicacion ? `<p><strong>📍 Lugar:</strong> ${evento.ubicacion}</p>` : ''}
                    ${evento.detalles ? `<p style="margin-top:5px; color:#666;">${evento.detalles}</p>` : ''}
                    
                    <button onclick="eliminarEvento(${evento.id})" style="background-color: var(--color-peligro-suave); color: var(--color-peligro-texto); border: none; padding: 8px 12px; border-radius: 8px; font-weight: bold; cursor: pointer; margin-top: 12px;">
                        Cancelar Evento
                    </button>
                </div>
            `;
        });

        // PINTAR TAREAS (CON CHECKLIST)
        tareasFiltradas.forEach(function(tarea) {
            let checked = tarea.estado === 'completada' ? 'checked' : '';
            let estiloTachado = tarea.estado === 'completada' ? 'opacity: 0.6; text-decoration: line-through;' : '';

            contenedor.innerHTML += `
                <div class="tarjeta-tarea" style="border-left: 4px solid var(--color-principal); transition: all 0.3s ease; ${estiloTachado}">
                    <h4 style="display: flex; align-items: center; gap: 10px;">
                        <input type="checkbox" ${checked} onchange="cambiarEstado(${tarea.id}, 'tarea', this)" style="width: 18px; height: 18px; cursor: pointer;">
                        📒 ${tarea.titulo}
                    </h4>
                    <p style="margin-top: 8px;"><strong>Categoría:</strong> ${tarea.categoria}</p>
                    <p><strong>Hora:</strong> ${tarea.hora || "Sin hora"}</p>
                    <p style="margin-top:5px; color:#666;">${tarea.descripcion || ""}</p>
                </div>
            `;
        });
    }
}

// NUEVA FUNCIÓN: Eliminar Evento y recargar la grilla
async function eliminarEvento(idEvento) {
    let confirmar = confirm("¿Seguro que quieres cancelar y eliminar este evento?");

    if (confirmar) {
        try {
            const respuesta = await fetch("php/eliminar_evento.php", {
                method: "POST",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify({ id: idEvento }) 
            });

            const resultado = await respuesta.json();

            if (resultado.success) {
                // Si se borró bien, volvemos a descargar la base de datos para refrescar la pantalla
                cargarAgenda(); 
            } else {
                alert("Error al cancelar el evento: " + resultado.message);
            }
        } catch (error) {
            console.error("Error:", error);
            alert("Hubo un problema de conexión al intentar eliminar.");
        }
    }
}



// 3. INICIALIZAR: En vez de llamar a crearCalendario(), llamamos a la base de datos
cargarAgenda();

// Función para marcar/desmarcar con el checkbox
async function cambiarEstado(id, tipo, checkboxElement) {
    const nuevoEstado = checkboxElement.checked ? 'completada' : 'pendiente';
    const tarjeta = checkboxElement.closest('.tarjeta-tarea');

    try {
        const respuesta = await fetch("php/toggle_estado.php", {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify({ id: id, tipo: tipo, estado: nuevoEstado })
        });

        const resultado = await respuesta.json();

        if (resultado.success) {
            // Efecto visual de tachado
            if (nuevoEstado === 'completada') {
                tarjeta.style.opacity = '0.6';
                tarjeta.style.textDecoration = 'line-through';
            } else {
                tarjeta.style.opacity = '1';
                tarjeta.style.textDecoration = 'none';
            }
            
            // Actualizamos la base de datos local en memoria para que no se pierda al cambiar de día
            if (tipo === 'tarea') {
                let t = listaTareas.find(x => x.id === id);
                if (t) t.estado = nuevoEstado;
            } else {
                let e = listaEventos.find(x => x.id === id);
                if (e) e.estado = nuevoEstado;
            }
        }
    } catch (error) {
        console.error("Error al cambiar estado:", error);
        checkboxElement.checked = !checkboxElement.checked; // Revertir visualmente si falla
    }
}