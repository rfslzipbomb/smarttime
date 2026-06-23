<?php require_once __DIR__ . '/php/session.php'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Smart Time - Ajustes de Cuenta</title>
    <link rel="stylesheet" href="assets/css/estilos.css">
    <style>
        /* Estilos básicos para el formulario integrados a tu diseño */
        .form-ajustes {
            background: #fff;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
            max-width: 600px;
            margin-top: 20px;
        }
        .form-grupo {
            margin-bottom: 20px;
        }
        .form-grupo label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #333;
        }
        .form-grupo input[type="text"],
        .form-grupo input[type="email"],
        .form-grupo input[type="password"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 8px;
            box-sizing: border-box;
        }
        .form-grupo input[type="file"] {
            margin-top: 5px;
        }
        .btn-guardar {
            background-color: #4CAF50; /* Cambia esto por tu color principal */
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 16px;
            width: 100%;
        }
        .btn-guardar:hover {
            background-color: #45a049;
        }
        .btn-volver {
            display: inline-block;
            margin-bottom: 20px;
            color: #666;
            text-decoration: none;
        }
    </style>
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
        
        <header class="top">
            <div><a href="perfil.php" class="btn-volver">← Volver al Perfil</a></div>
            <div class="top-user">
                <div>
                    <h4>Hola, <?php echo htmlspecialchars($_SESSION['usuario_name']); ?></h4>
                </div>
            </div>
        </header>

        <h2 class="titulo">Ajustes de Cuenta</h2>
        
        <?php if(isset($_GET['mensaje']) && $_GET['mensaje'] == 'exito'): ?>
            <div style="background-color: #d4edda; color: #155724; padding: 15px; border-radius: 8px; margin-bottom: 20px;">
                ¡Tus datos han sido actualizados exitosamente!
            </div>
        <?php endif; ?>
        
        <?php if(isset($_GET['error'])): ?>
            <div style="background-color: #f8d7da; color: #721c24; padding: 15px; border-radius: 8px; margin-bottom: 20px;">
                Error: <?php echo htmlspecialchars(urldecode($_GET['error'])); ?>
            </div>
        <?php endif; ?>

        <form action="php/actualizar_perfil.php" method="POST" enctype="multipart/form-data" class="form-ajustes">
            
            <div class="form-grupo">
                <label for="nombre">Nombre Completo</label>
                <input type="text" id="nombre" name="nombre" value="<?php echo htmlspecialchars($_SESSION['usuario_name']); ?>" required>
            </div>

            <div class="form-grupo">
                <label for="email">Correo Electrónico</label>
                <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($_SESSION['usuario_email']); ?>" required>
            </div>

            <div class="form-grupo">
                <label for="password">Nueva Contraseña <small>(Deja en blanco si no deseas cambiarla)</small></label>
                <input type="password" id="password" name="password" placeholder="Escribe tu nueva contraseña">
            </div>

            <div class="form-grupo">
                <label for="foto_perfil">Foto de Perfil <small>(Solo JPG/JPEG. Deja en blanco para mantener la actual)</small></label>
                <br>
                <img src="<?php echo htmlspecialchars($_SESSION['usuario_foto']); ?>" alt="Foto actual" style="width: 60px; height: 60px; border-radius: 50%; object-fit: cover; margin-bottom: 10px;">
                <input type="file" id="foto_perfil" name="foto_perfil" accept=".jpg, .jpeg">
            </div>

            <button type="submit" class="btn-guardar">Guardar Cambios</button>

        </form>

    </main>

</div>

<script src="assets/js/topbar.js"></script>
</body>
</html>