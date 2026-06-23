<?php require_once __DIR__ . '/php/session.php'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Smart Time - Nuevo Evento</title>
    <link rel="stylesheet" href="assets/css/estilos.css">
</head>
<body>

<div class="app">
    <aside class="sidebar">
        <div>
            <div class="logo">
                <img src="assets/imagenes/logo.png" alt="Logo Smart Time" class="logo-img">
                <div>
                    <h2>Smart <span>Time</span></h2>
                    <p>Agenda Profesional Inteligente</p>
                </div>
            </div>
            <nav class="menu">
                <a href="tareas.php">📋 Tareas</a>
                <a href="nuevo_evento.php" class="activo">🎉 Eventos</a>
                <a href="calendario.php">📅 Calendario</a>
                <!-- NUEVO ENLACE AL MENÚ -->
                <a href="consejos.php">🌱 Bienestar</a>
                <a href="perfil.php">👤 Perfil</a>
            </nav>
        </div>
        <div>
            <!-- EL BLOQUE DE BIENESTAR ESTÁTICO FUE ELIMINADO DE AQUÍ -->
            <div class="usuario">
                <img src="<?php echo htmlspecialchars($_SESSION['usuario_foto']); ?>" class="foto" alt="Foto de perfil">
                <div>
                    <h4><?php echo htmlspecialchars($_SESSION['usuario_name']); ?></h4>
                    <p><?php echo htmlspecialchars($_SESSION['usuario_email']); ?></p>
                </div>
            </div>
        </div>
    </aside>

    <main class="contenido">
        <header class="superior">
            <a href="calendario.php" class="volver"><span>←</span> Volver al Calendario</a>
            <div class="top-user">
                <div><h4>Hola, <?php echo htmlspecialchars($_SESSION['usuario_name']); ?></h4></div>
            </div>
        </header>

        <section class="titulo">
            <h1>Programar Evento</h1>
            <p>Registra celebraciones, ceremonias y convenciones.</p>
        </section>

        <section class="formulario-tarea">
            <form id="form-evento">
                <label>Título del Evento</label>
                <input type="text" id="titulo" placeholder="Ej. Boda de Carlos y Ana" required style="margin-bottom: 15px;">

                <div class="fila-formulario" style="margin-bottom: 15px;">
                    <div>
                        <label>Tipo de Evento</label>
                        <select id="tipo" style="width: 100%; padding: 15px; border: 1px solid var(--color-borde); border-radius: 8px; margin-top: 5px;">
                            <option value="Fiesta/Celebración">Fiesta / Celebración</option>
                            <option value="Ceremonia religiosa">Ceremonia Religiosa</option>
                            <option value="Convención profesional">Convención Profesional</option>
                            <option value="Compromiso personal">Compromiso Personal</option>
                        </select>
                    </div>
                    <div>
                        <label>Código de Vestimenta</label>
                        <input type="text" id="vestimenta" placeholder="Ej. Formal, Etiqueta, Casual...">
                    </div>
                </div>

                <label>Ubicación</label>
                <input type="text" id="ubicacion" placeholder="Dirección o lugar del evento" style="margin-bottom: 15px;">

                <div class="fila-formulario" style="margin-bottom: 15px;">
                    <div>
                        <label>Fecha</label>
                        <input type="date" id="fecha" required>
                    </div>
                    <div style="display: flex; gap: 10px;">
                        <div style="width: 50%;">
                            <label>Hora Inicio</label>
                            <input type="time" id="hora_inicio">
                        </div>
                        <div style="width: 50%;">
                            <label>Hora Fin</label>
                            <input type="time" id="hora_fin">
                        </div>
                    </div>
                </div>

                <label>Notas y Detalles</label>
                <textarea id="detalles" placeholder="Escribe detalles adicionales..."></textarea>

                <div class="centrar" style="margin-top: 20px;">
                    <button type="submit" class="btn-guardar">Guardar Evento</button>
                </div>
            </form>
        </section>
    </main>
</div>

<script src="assets/js/nuevo_evento.js"></script>
<script src="assets/js/topbar.js"></script>
<div class="modal-conflicto" id="modal-conflicto">
    <div class="modal-conflicto-contenido">
        <div class="icono-error-modal">⚠️</div>
        <h2 style="margin-bottom: 10px;">Conflicto de Horario</h2>
        <p id="texto-conflicto" style="color: var(--color-texto-secundario); font-size: 15px; line-height: 1.5;"></p>
        <button class="btn-entendido" onclick="document.getElementById('modal-conflicto').style.display='none'">Entendido</button>
    </div>
</div>
</body>
</html>