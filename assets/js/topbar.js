document.addEventListener('DOMContentLoaded', async () => {
    const btnCampana = document.getElementById('btn-campana');
    const dropdown = document.getElementById('dropdown-notificaciones');
    const listaNotificaciones = document.getElementById('lista-notificaciones');
    const contadorCampana = document.getElementById('contador-campana');

    if (btnCampana && dropdown) {
        btnCampana.addEventListener('click', (e) => {
            dropdown.classList.toggle('mostrar');
            e.stopPropagation();
        });

        window.addEventListener('click', (e) => {
            if (!btnCampana.contains(e.target)) {
                dropdown.classList.remove('mostrar');
            }
        });
    }

    try {
        const respuesta = await fetch("php/obtener_agenda.php");
        const resultado = await respuesta.json();

        if (resultado.success) {
            const hoy = new Date();
            const hoyStr = `${hoy.getFullYear()}-${String(hoy.getMonth() + 1).padStart(2, '0')}-${String(hoy.getDate()).padStart(2, '0')}`;

            let notificaciones = [];
            let conteoPorFecha = {};
            
            // Unimos tareas y eventos para evaluarlos juntos
            const todasLasActividades = [...resultado.tareas, ...resultado.eventos];

            // 1. Agrupar todo por fecha (Ignorando días pasados)
            todasLasActividades.forEach(act => {
                if (act.fecha >= hoyStr) {
                    if (!conteoPorFecha[act.fecha]) conteoPorFecha[act.fecha] = 0;
                    conteoPorFecha[act.fecha]++;
                }
            });

            // 2. Evaluar reglas de notificación
            
            // Regla A: Eventos para HOY
            const eventosHoy = resultado.eventos.filter(e => e.fecha === hoyStr);
            if (eventosHoy.length > 0) {
                notificaciones.push({
                    tipo: 'peligro',
                    texto: `<strong>¡Hoy tienes evento!</strong> "${eventosHoy[0].titulo}". Revisa tu agenda.`
                });
            }

            // Regla B: Detectar Saturación (> 3 significa 4 o más actividades) en CUALQUIER día
            for (const [fecha, total] of Object.entries(conteoPorFecha)) {
                if (total > 3) { // Si quieres que alerte desde 3 exactos, cámbialo a >= 3
                    let fechaTexto = (fecha === hoyStr) ? "hoy" : `el ${fecha}`;
                    notificaciones.push({
                        tipo: 'advertencia',
                        texto: `<strong>Día saturado:</strong> Tienes ${total} actividades programadas para ${fechaTexto}.`
                    });
                }
            }

            // 3. Imprimir Notificaciones en la interfaz
            if (notificaciones.length > 0) {
                contadorCampana.textContent = notificaciones.length;
                contadorCampana.style.display = 'grid'; 
                
                listaNotificaciones.innerHTML = '';
                notificaciones.forEach(notif => {
                    listaNotificaciones.innerHTML += `
                        <div class="item-notificacion ${notif.tipo}">
                            <div>❕</div>
                            <div>${notif.texto}</div>
                        </div>
                    `;
                });
            } else {
                listaNotificaciones.innerHTML = '<p style="text-align:center; color:#888; font-size:13px; margin: 10px 0;">Todo tranquilo. No hay alertas nuevas.</p>';
                contadorCampana.style.display = 'none';
            }
        }
    } catch (error) {
        console.error("Error al cargar notificaciones:", error);
    }
});