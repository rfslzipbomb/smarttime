let fechaActual = new Date();
let diaSeleccionado = null;

const meses = [
    "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio",
    "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"
];

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

    for (let i = primerDia; i > 0; i--) {
        const dia = document.createElement("span");
        dia.textContent = ultimoDiaMesAnterior - i + 1;
        dia.classList.add("gris");
        contenedorDias.appendChild(dia);
    }

    for (let i = 1; i <= ultimoDiaMes; i++) {
        const dia = document.createElement("span");
        dia.textContent = i;

        dia.onclick = function () {
            seleccionarDia(dia, i, mes, anio);
        };

        contenedorDias.appendChild(dia);
    }

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

mostrarTareasDelDia(diaSeleccionado);
}
    
crearCalendario();

function mostrarTareasDelDia(fechaSeleccionada) {
    const contenedor = document.getElementById("contenedor-tareas");
    const contador = document.getElementById("contador-tareas");

    let tareas = JSON.parse(localStorage.getItem("tareas")) || [];

    let tareasFiltradas = tareas.filter(function(tarea) {
        return tarea.fecha === fechaSeleccionada;
    });

    contador.textContent = tareasFiltradas.length + " Tareas";

    if (tareasFiltradas.length === 0) {
        contenedor.innerHTML = `
            <div class="imagen-tarea">📋</div>
            <h3>No hay tareas para este día</h3>
            <p>Disfruta tu día o agrega nuevas tareas para mantenerte productivo.</p>
            <a href="nueva_tarea.html" class="btn-agregar">+ Agregar tarea</a>
        `;
    } else {
        contenedor.innerHTML = "";

        tareasFiltradas.forEach(function(tarea) {
            contenedor.innerHTML += `
                <div class="tarjeta-tarea">
                    <h4>${tarea.titulo}</h4>
                    <p><strong>Categoría:</strong> ${tarea.categoria}</p>
                    <p><strong>Hora:</strong> ${tarea.hora || "Sin hora"}</p>
                    <p>${tarea.descripcion || "Sin descripción"}</p>
                </div>
            `;
        });
    }
}