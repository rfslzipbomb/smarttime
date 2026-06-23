<?php require_once __DIR__ . '/php/session.php'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Smart Time - Ayuda y Soporte</title>
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
                <a href="nuevo_evento.php">🎉 Eventos</a>
                <a href="calendario.php">📅 Calendario</a>
                <!-- NUEVO ENLACE AL MENÚ -->
                <a href="consejos.php">🌱 Bienestar</a>
                <a href="perfil.php" class="activo">👤 Perfil</a>
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
            <a href="perfil.php" class="volver">
                <span>←</span> Volver al Perfil
            </a>
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
                </div>
            </div>
        </header>

        <section class="titulo">
            <h1>Ayuda y Soporte</h1>
            <p>Encuentra respuestas rápidas o contáctanos para asistencia.</p>
        </section>

        <section class="config-grid" style="margin-top: 25px; margin-bottom: 35px;">
            <div class="config-card">
                <div class="icono-config">✉️</div>
                <div>
                    <h3>Soporte por Correo</h3>
                    <p>Escríbenos a <strong>soporte@smarttime.com</strong>. Respondemos en menos de 24h.</p>
                </div>
            </div>
            <div class="config-card">
                <div class="icono-config">📞</div>
                <div>
                    <h3>Atención Telefónica</h3>
                    <p>Llámanos al <strong>123-456-7890</strong> (Lun - Vie, 9:00 AM a 5:00 PM).</p>
                </div>
            </div>
        </section>

        <section>
            <h2 style="margin-bottom: 15px; color: var(--color-texto);">Preguntas Frecuentes</h2>
            
            <div class="faq-contenedor">
                <details class="faq-item">
                    <summary>¿Cómo puedo restablecer mi contraseña?</summary>
                    <div class="faq-respuesta">
                        <p>Para restablecer tu contraseña o cambiarla de manera segura, debes dirigirte a la sección de <strong>"Ajustes de Cuenta"</strong> desde tu perfil. Allí encontrarás un campo para ingresar tu nueva contraseña. Si olvidaste tu contraseña y no puedes iniciar sesión, utiliza el botón "¿Olvidaste tu contraseña?" en la pantalla de ingreso.</p>
                    </div>
                </details>

                <details class="faq-item">
                    <summary>¿Cómo puedo actualizar mi información y foto de perfil?</summary>
                    <div class="faq-respuesta">
                        <p>Ve a tu <strong>Perfil</strong> y haz clic en la tarjeta de <strong>"Ajustes de Cuenta"</strong>. Desde allí podrás modificar tu nombre completo, correo electrónico y subir una nueva fotografía (recuerda que solo aceptamos formatos JPG o JPEG).</p>
                    </div>
                </details>

                <details class="faq-item">
                    <summary>¿Qué pasa si programo tareas y eventos en el mismo horario?</summary>
                    <div class="faq-respuesta">
                        <p>El sistema cuenta con una función de prevención de conflictos. Si intentas guardar una nueva actividad en el horario exacto de otra que ya existe, la plataforma te alertará inmediatamente con una advertencia en pantalla para evitar que satures tu agenda.</p>
                    </div>
                </details>
            </div>
        </section>

    </main>

</div>

<script src="assets/js/topbar.js"></script>
</body>
</html>