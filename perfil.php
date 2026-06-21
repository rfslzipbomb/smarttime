<?php require_once __DIR__ . '/php/session.php'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Smart Time - Perfil</title>
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
                <a href="calendario.php">📅 Calendario</a>
                <a href="perfil.php" class="activo">👤 Perfil</a>
            </nav>

        </div>

        <div>

            <div class="bienestar">
                <div class="icono">♡</div>

                <h4>Bienestar en tu jornada</h4>

                <p>
                    Recuerda tomar pausas,
                    beber agua y mantener
                    hábitos saludables.
                </p>

                <a href="consejos.html">Ver consejos ›</a>
            </div>

            
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

        <header class="top">

            <div></div>

            <div class="top-user">

                <div class="campana">
                    🔔
                    <span>3</span>
                </div>

                <div>
                    <h4>Hola, <?php echo htmlspecialchars($_SESSION['usuario_name']); ?></h4>
                    <p>¡Que tengas un gran día! 👋</p>
                </div>

            </div>

        </header>

        <section class="perfil-header">

            <div class="foto-perfil">
                <img src="<?php echo htmlspecialchars($_SESSION['usuario_foto']); ?>" alt="Foto de perfil">
                <button>✎</button>
            </div>

            <div class="datos">
                <h1><?php echo htmlspecialchars($_SESSION['usuario_name']); ?></h1>
                <p><?php echo htmlspecialchars($_SESSION['usuario_email']); ?></p>
            </div>

            <div class="resumen">

                <div class="card-numero">
                    <h2>1</h2>
                    <p>Pendientes</p>
                </div>

                <div class="card-numero">
                    <h2>0</h2>
                    <p>Completadas</p>
                </div>

            </div>

        </section>

        <h2 class="titulo">Configuración</h2>

        <section class="config-grid">

            <a href="ajustes.php" class="config-card" style="text-decoration: none; color: inherit; display: flex; align-items: center;">
                <div class="icono-config">⚙️</div>

                <div>
                    <h3>Ajustes de Cuenta</h3>
                    <p>
                        Administra tu información personal
                        y preferencias de la cuenta.
                    </p>
                </div>

                <span>›</span>
            </a>

            <div class="config-card">
                <div class="icono-config">🔔</div>

                <div>
                    <h3>Notificaciones</h3>
                    <p>
                        Personaliza cómo y cuándo
                        quieres recibir notificaciones.
                    </p>
                </div>

                <span>›</span>
            </div>

            <div class="config-card">
                <div class="icono-config">❓</div>

                <div>
                    <h3>Ayuda y Soporte</h3>
                    <p>
                        Obtén ayuda y encuentra respuestas
                        a tus preguntas frecuentes.
                    </p>
                </div>

                <span>›</span>
            </div>

            <div class="config-card">
                <div class="icono-config">🛡️</div>

                <div>
                    <h3>Privacidad</h3>
                    <p>
                        Consulta nuestras políticas y controla
                        el manejo de tu información.
                    </p>
                </div>

                <span>›</span>
            </div>

        </section>

        <button class="cerrar" onclick="window.location.href='php/logout.php'">Cerrar Sesión</button>

        <a href="nueva_tarea.php" class="boton-flotante">+</a>

    </main>

</div>

</body>
</html>