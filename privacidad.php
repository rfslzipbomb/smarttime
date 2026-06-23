<?php require_once __DIR__ . '/php/session.php'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Smart Time - Política de Privacidad</title>
    <link rel="stylesheet" href="assets/css/estilos.css">
</head>
<body>

<div class="app">

    <!-- BARRA LATERAL -->
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

    <!-- CONTENIDO PRINCIPAL -->
    <main class="contenido">

        <!-- BARRA SUPERIOR -->
        <header class="superior">
            <a href="perfil.php" class="volver">
                <span>←</span> Volver al Perfil
            </a>
            <div class="top-user">
                <!-- Contenedor dinámico de la campana -->
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
            <h1>Política de Privacidad</h1>
            <p>Conoce cómo recopilamos, usamos y protegemos tu información.</p>
        </section>

        <!-- CONTENEDOR DEL DOCUMENTO -->
        <section style="background: var(--color-blanco); padding: 40px; border-radius: 18px; box-shadow: var(--sombra); margin-top: 25px; margin-bottom: 40px; color: var(--color-texto-secundario); line-height: 1.7; font-size: 15px;">
            
            <h2 style="color: var(--color-texto); font-size: 20px; margin-bottom: 12px;">1. Información que Recopilamos</h2>
            <p style="margin-bottom: 28px;">Recopilamos información personal que nos proporcionas voluntariamente al registrarte en nuestro sitio, como tu nombre, dirección de correo electrónico y cualquier otra información que decidas compartir con nosotros en tu perfil.</p>

            <h2 style="color: var(--color-texto); font-size: 20px; margin-bottom: 12px;">2. Uso de la Información</h2>
            <p style="margin-bottom: 28px;">Utilizamos la información que recopilamos para mejorar nuestros servicios, personalizar tu experiencia en la agenda y comunicarnos contigo sobre actualizaciones, alertas de horarios y noticias relacionadas con tu cuenta en Smart Time.</p>

            <h2 style="color: var(--color-texto); font-size: 20px; margin-bottom: 12px;">3. Protección de la Información</h2>
            <p style="margin-bottom: 28px;">Implementamos medidas de seguridad para proteger tu información personal y tareas contra accesos no autorizados, alteraciones, divulgación o destrucción. Sin embargo, ten en cuenta que ningún método de transmisión por Internet o método de almacenamiento electrónico es completamente seguro.</p>

            <h2 style="color: var(--color-texto); font-size: 20px; margin-bottom: 12px;">4. Compartir Información con Terceros</h2>
            <p style="margin-bottom: 28px;">No vendemos, intercambiamos ni alquilamos tu información personal a terceros. Sin embargo, podemos compartir tu información con proveedores de servicios de confianza que nos ayudan a operar nuestro sistema o brindarte servicios, siempre y cuando estas partes acuerden mantener esta información confidencial.</p>

            <h2 style="color: var(--color-texto); font-size: 20px; margin-bottom: 12px;">5. Uso de Cookies</h2>
            <p style="margin-bottom: 28px;">Utilizamos cookies y variables de sesión para mantener tu cuenta activa y mejorar tu experiencia. Puedes configurar tu navegador para rechazar las cookies, pero ten en cuenta que el inicio de sesión y otras partes de nuestro sitio no funcionarán correctamente si lo haces.</p>

            <h2 style="color: var(--color-texto); font-size: 20px; margin-bottom: 12px;">6. Enlaces a Otros Sitios</h2>
            <p style="margin-bottom: 28px;">Nuestro sitio web puede contener enlaces a otros sitios externos. Si haces clic en un enlace de terceros, serás dirigido a ese sitio. Te recomendamos revisar la política de privacidad de cada sitio que visites, ya que no tenemos control sobre sus prácticas.</p>

            <h2 style="color: var(--color-texto); font-size: 20px; margin-bottom: 12px;">7. Cambios en Nuestra Política</h2>
            <p style="margin-bottom: 28px;">Nos reservamos el derecho de actualizar nuestra política de privacidad en cualquier momento. Te notificaremos sobre cualquier cambio publicando la nueva versión en esta página. Te recomendamos revisarla periódicamente.</p>

            <div style="background-color: var(--color-fondo); padding: 20px; border-radius: 12px; border-left: 4px solid var(--color-principal); margin-top: 35px;">
                <h3 style="color: var(--color-texto); font-size: 16px; margin-bottom: 8px;">¿Dudas o Consultas?</h3>
                <p style="margin: 0;">Si tienes alguna pregunta sobre esta política, no dudes en contactarnos enviándonos un correo electrónico a <strong>privacidad@smarttime.com</strong>.</p>
            </div>

        </section>

    </main>

</div>

<script src="assets/js/topbar.js"></script>
</body>
</html>