<?php require_once __DIR__ . '/php/session.php'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Smart Time - Nueva Tarea</title>
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
                <a href="calendario.php">📅 Calendario</a>
                <a href="perfil.php">👤 Perfil</a>
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

        <header class="superior">
            <a href="calendario.php" class="volver">
    <span>←</span>
    Volver al Calendario
</a>

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

        <section class="titulo">
            <h1>Nueva Tarea</h1>
            <p>Completa la información para crear una nueva tarea.</p>
        </section>

        <section class="formulario-tarea">

            <form id="form-tarea">

    <label>Título de la Tarea</label>
    <p>Escribe el título de la tarea</p>
    <input type="text" id="titulo" placeholder="✎  Ej. Reunión de equipo" required>

    <label>Categoría</label>

    <div class="categorias">
        <button type="button" class="categoria activa" data-categoria="Trabajo">💼 Trabajo</button>
        <button type="button" class="categoria" data-categoria="Personal">👤 Personal</button>
        <button type="button" class="categoria" data-categoria="Estudios">🎓 Estudios</button>
    </div>

    <div class="fila-formulario">
        <div>
            <label>Fecha</label>
            <p>Seleccionar fecha</p>
            <input type="date" id="fecha" required>
        </div>

        <div>
            <label>Hora</label>
            <p>Seleccionar hora</p>
            <input type="time" id="hora">
        </div>
    </div>

    <label>Descripción</label>
    <p>Detalles adicionales opcional</p>
    <textarea id="descripcion" placeholder="Escribe aquí..."></textarea>

    <div class="centrar">
        <button type="submit" class="btn-guardar">Guardar Tarea</button>
        <p class="nota">ⓘ El título y la fecha son obligatorios</p>
    </div>

</form>

        </section>
</main>

<script src="assets/js/nueva_tarea.js"></script>

</body>
</html>