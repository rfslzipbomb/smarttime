<?php require_once __DIR__ . '/php/session.php'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Smart Time - Calendario</title>
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
                <a href="tareas.php">📋 Tareas</a>
                <a href="nuevo_evento.php">🎉 Eventos</a>
                <a href="calendario.php" class="activo">📅 Calendario</a>
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
            <h1>Mi Agenda</h1>
            <p>Organiza tus días y actividades</p>
        </section>

        <section class="paneles">

            <div class="calendario">

                <div class="encabezado-calendario">
                    <h2 id="mes-anio">Junio 2026</h2>

                    <div class="controles-calendario">
                        <button onclick="cambiarMes(-1)">‹</button>
                        <button onclick="cambiarMes(1)">›</button>
                    </div>
                </div>

                <div class="dias-semana">
                    <span>Dom</span>
                    <span>Lun</span>
                    <span>Mar</span>
                    <span>Mié</span>
                    <span>Jue</span>
                    <span>Vie</span>
                    <span>Sáb</span>
                </div>

                <div class="dias" id="dias-calendario">
                    <!-- Los días se generan con JavaScript -->
                </div>

            </div>

            <div class="tareas-dia">

                <div class="encabezado-tareas">
                    <h2>Tareas del día</h2>
                    <span id="contador-tareas">0 Tareas</span>
                </div>

                <div class="sin-tareas" id="contenedor-tareas">
                    <div class="imagen-tarea">📋</div>
                    <h3>No hay tareas para este día</h3>
                    <p>Disfruta tu día o agrega nuevas tareas para mantenerte productivo.</p>
                    <a href="nueva_tarea.php" class="btn-agregar">+ Agregar tarea</a>
                </div>

            </div>

        </section>

        <a href="nueva_tarea.php" class="boton-flotante">+</a>

    </main>

    <script src="assets/js/calendario.js"></script>
    <script src="assets/js/topbar.js"></script>  
</body>
</html>