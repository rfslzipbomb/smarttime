<?php require_once __DIR__ . '/php/session.php'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Smart Time - Tareas</title>
    <link rel="stylesheet" href="assets/css/estilos.css">
</head>
<body>

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
                <a href="tareas.php" class="activo">📋 Tareas</a>
                <a href="nuevo_evento.php">🎉 Eventos</a>
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
            <div></div>

            <div></div>

            <div class="top-user">

                <div class="campana-contenedor" id="btn-campana">
                    <div class="campana">
                        🔔
                        <span id="contador-campana" style="display:none;">0</span>
                    </div>
                    
                    <div class="dropdown-notificaciones" id="dropdown-notificaciones">
                        <h4>Notificaciones</h4>
                        <div id="lista-notificaciones">
                            </div>
                    </div>
                </div>

                <div>
                    <h4>Hola, <?php echo htmlspecialchars($_SESSION['usuario_name']); ?></h4>
                    <p>¡Que tengas un gran día! 👋</p>
                </div>

            </div>

        </header>

        <section class="titulo">
            <h1>Hola, <?php echo htmlspecialchars($_SESSION['usuario_name']); ?></h1>
            <p>Organiza tu trabajo y cuida tu bienestar</p>
        </section>

        <section class="buscador-tareas">
            <input type="text" placeholder="🔍  Buscar tareas...">
        </section>

        <section class="filtros-tareas">
    <button class="filtro activo" data-filtro="Todas">▦ Todas</button>
    <button class="filtro" data-filtro="Trabajo">💼 Trabajo</button>
    <button class="filtro" data-filtro="Personal">👤 Personal</button>
    <button class="filtro" data-filtro="Estudios">🎓 Estudios</button>
</section>

        <section class="panel-tareas">

            <div class="encabezado-lista">
                <h2>Tareas</h2>
                <span>1 tarea</span>
            </div>

            <div class="lista-tareas">

            </div>

        </section>

        <a href="nueva_tarea.php" class="boton-flotante">+</a>

        <a href="nueva_tarea.php" class="boton-flotante">+</a>

        <div id="modal-tarea" class="modal-overlay">
            <div class="modal-tarjeta">
                <span class="btn-cerrar-modal">&times;</span>
                <div id="modal-contenido-detalle">
                    </div>
            </div>
        </div>

    </main>
    <script src="assets/js/tareas.js"></script>
    <script src="assets/js/topbar.js"></script>
</body>
</html>