<?php require_once __DIR__ . '/php/session.php'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Smart Time - Bienestar y Consejos</title>
    <link rel="stylesheet" href="assets/css/estilos.css">
</head>
<body>

<div class="app">

    <!-- Se inyecta la sidebar que definimos arriba -->
    <aside class="sidebar">
        <div>
            <div class="logo">
                <img src="assets/imagenes/logo.png" alt="Logo Smart Time" class="logo-img">
                <div>
                    <h2>Smart <span>Time</span></h2>
                    <p>Agenda Profesional</p>
                </div>
            </div>
            <nav class="menu">
                <a href="tareas.php">📋 Tareas</a>
                <a href="nuevo_evento.php">🎉 Eventos</a>
                <a href="calendario.php">📅 Calendario</a>
                <a href="consejos.php" class="activo">🌱 Bienestar</a>
                <a href="perfil.php">👤 Perfil</a>
            </nav>
        </div>
        <div>
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

        <!-- Barra superior integrada con notificaciones -->
        <header class="superior">
            <div></div> <!-- Espacio vacío para alinear -->
            <div class="top-user">
                <div class="campana-contenedor" id="btn-campana">
                    <div class="campana">🔔<span id="contador-campana" style="display:none;">0</span></div>
                    <div class="dropdown-notificaciones" id="dropdown-notificaciones">
                        <h4>Notificaciones</h4>
                        <div id="lista-notificaciones"></div>
                    </div>
                </div>
                <div>
                    <h4>Hola, <?php echo htmlspecialchars($_SESSION['usuario_name']); ?></h4>
                    <p>¡Cuida tu salud hoy! 👋</p>
                </div>
            </div>
        </header>

        <section class="titulo">
            <h1>Consejos y Bienestar</h1>
            <p>Pequeñas acciones para tu bienestar y productividad.</p>
        </section>

        <section class="card-consejo">
            <div class="icono-grande">💡</div>
            <div>
                <h2 style="font-size: 18px; margin-bottom: 5px;">Consejo de hoy</h2>
                <p style="color: var(--color-texto-secundario); font-size: 14px; line-height: 1.5;">
                    “Completa primero la tarea más importante de tu lista.
                    Esto reduce el estrés y aumenta la sensación de progreso en tu jornada.”
                </p>
            </div>
            <div class="imagen-bienestar">🌱</div>
        </section>

        <h2 class="subtitulo-consejos">Tu progreso de bienestar hoy</h2>

        <section class="progreso-grid">

            <div class="card-progreso">
                <div class="icono-agua">💧</div>
                <h3>Vasos de agua</h3>
                <p style="color: var(--color-texto-secundario); font-size: 13px;">Meta diaria: 8 vasos</p>

                <div class="contador-circular">
                    <h2 id="contador-agua">0</h2>
                    <span style="font-size: 12px; color: var(--color-gris);">de 8</span>
                </div>

                <div class="botones-contador">
                    <button onclick="restarAgua()">−</button>
                    <button onclick="sumarAgua()">+</button>
                </div>
                <p class="mensaje" style="font-weight: bold; color: var(--color-principal);">💧 ¡Sigue hidratándote!</p>
            </div>

            <div class="card-progreso">
                <div class="icono-pausa">🚶</div>
                <h3>Pausas activas</h3>
                <p style="color: var(--color-texto-secundario); font-size: 13px;">Meta diaria: 3 pausas</p>

                <div class="contador-circular verde">
                    <h2 id="contador-pausas">0</h2>
                    <span style="font-size: 12px; color: var(--color-gris);">de 3</span>
                </div>

                <div class="botones-contador">
                    <button onclick="restarPausa()">−</button>
                    <button onclick="sumarPausa()">+</button>
                </div>
                <p class="mensaje" style="font-weight: bold; color: #16a34a;">🌿 ¡Tu cuerpo te lo agradecerá!</p>
            </div>

        </section>
    </main>
</div>

<script src="assets/js/topbar.js"></script>
<script src="assets/js/consejos.js"></script>
</body>
</html>