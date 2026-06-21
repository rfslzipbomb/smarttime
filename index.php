<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Smart Time - Agenda Profesional Inteligente</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        :root {
            --st-primary-blue: #2563EB;
            /* Azul de los botones y textos resaltados */
            --st-bg-light-blue: #F0F9FF;
            /* Fondo claro de la izquierda */
            --st-text-dark: #1F2937;
            /* Color de texto principal */
            --st-text-muted: #6B7280;
            /* Color de texto secundario */
        }

        body {
            font-family: system-ui, -apple-system, sans-serif;
            color: var(--st-text-dark);
            background-color: #fff;
        }

        /* Estilos para el contenedor principal de la página completa */
        .full-page-container {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .main-content {
            flex: 1;
            display: flex;
        }

        /* Estilos de la columna izquierda (Fondo, Padding) */
        .left-panel {
            background-color: var(--st-bg-light-blue);
            padding: 4rem 3rem;
            position: relative;
        }

        .hero-title {
            font-weight: 800;
            line-height: 1.2;
            margin-bottom: 1.5rem;
        }

        .hero-text-blue {
            color: var(--st-primary-blue);
        }

        .feature-icon-wrapper {
            background-color: #DBEAFE;
            /* Fondo azul muy claro para iconos */
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 48px;
            height: 48px;
            margin-right: 1rem;
        }

        .feature-icon {
            font-size: 1.5rem;
            color: var(--st-primary-blue);
        }

        .feature-title {
            font-weight: 600;
            margin-bottom: 0.25rem;
        }

        .hr-callout {
            background-color: rgba(37, 99, 235, 0.05);
            /* Fondo muy claro */
            border: 1px solid rgba(37, 99, 235, 0.1);
            border-radius: 12px;
            padding: 1rem;
            margin-top: 2rem;
        }

        /* Estilos de la columna derecha (Fondo blanco) */
        .right-panel {
            background-color: #fff;
            padding: 4rem 3rem;
        }

        .login-card {
            border: none;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
            /* Sombra suave */
            border-radius: 20px;
        }

        .login-title {
            font-weight: 800;
        }

        /* Input con bordes redondeados y sombra interior suave */
        .form-control-custom {
            border-radius: 12px;
            padding: 1.25rem;
            border: 1px solid #E5E7EB;
            box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.05);
        }

        .form-control-custom:focus {
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
            border-color: var(--st-primary-blue);
        }

        /* Botón de inicio de sesión */
        .btn-st-primary {
            background-color: var(--st-primary-blue);
            color: #fff;
            border-radius: 12px;
            padding: 1.25rem;
            border: none;
            font-weight: 600;
        }

        .btn-st-primary:hover {
            background-color: #1d4ed8;
            color: #fff;
        }

        /* Botón de registro */
        .btn-st-secondary {
            background-color: #fff;
            color: var(--st-primary-blue);
            border: 1px solid #E5E7EB;
            border-radius: 12px;
            padding: 1.25rem;
            font-weight: 600;
        }

        .btn-st-secondary:hover {
            background-color: #F9FAFB;
            color: var(--st-primary-blue);
        }

        /* Pie de página */
        footer {
            border-top: 1px solid #E5E7EB;
            color: var(--st-text-muted);
            font-size: 0.875rem;
        }
    </style>
</head>
<script src="assets/js/app.js"></script>

<body class="bg-light">

    <div class="full-page-container">

        <nav class="navbar navbar-expand-lg navbar-light bg-light py-3 border-bottom">
            <div class="container-fluid px-5">
                <a class="navbar-brand d-flex align-items-center" href="#">
                    <img src="assets/imagenes/logo.png" alt="Icono" width="30" height="30" class="me-2"> <span
                        class="fs-4 fw-bold">Smart Time</span>
                </a>
                <span class="navbar-text text-muted">Agenda Profesional Inteligente</span>
            </div>
        </nav>

        <div class="main-content">
            <div class="col-lg-6 left-panel">
                <div class="container-fluid px-0">
                    <h1 class="hero-title">Organiza el trabajo,<br><span class="hero-text-blue">cuida a tu
                            equipo.</span></h1>
                    <p class="text-muted mb-5">
                        Smart Time es la plataforma inteligente que ayuda a las empresas a mejorar la productividad y el
                        bienestar de sus colaboradores.
                    </p>

                    <div class="d-flex align-items-start mb-4">
                        <div class="feature-icon-wrapper">
                            <i class="bi bi-calendar-event feature-icon"></i>
                        </div>
                        <div>
                            <h4 class="feature-title">Agenda y tareas priorizadas con IA</h4>
                        </div>
                    </div>

                    <div class="d-flex align-items-start mb-4">
                        <div class="feature-icon-wrapper">
                            <i class="bi bi-heart feature-icon"></i>
                        </div>
                        <div>
                            <h4 class="feature-title">Hábitos saludables:<br>pausas, agua y bienestar</h4>
                        </div>
                    </div>

                    <div class="d-flex align-items-start mb-4">
                        <div class="feature-icon-wrapper">
                            <i class="bi bi-bar-chart feature-icon"></i>
                        </div>
                        <div>
                            <h4 class="feature-title">Reportes y análisis<br>para RRHH</h4>
                        </div>
                    </div>

                    <div class="hr-callout d-flex align-items-center mt-5">
                        <i class="bi bi-people feature-icon me-3"></i>
                        <div>
                            <h5 class="feature-title mb-1">Pensado para Recursos Humanos</h5>
                            <p class="text-muted mb-0 small">Mejora la organización, reduce la sobrecarga laboral y
                                promueve el bienestar de tu equipo.</p>
                        </div>
                    </div>

                </div>
            </div>

            <div class="col-lg-6 right-panel d-flex align-items-center justify-content-center">
                <div class="card shadow-sm p-5 login-card">
                    <div class="text-center mb-5">
                        <div class="feature-icon-wrapper mx-auto mb-3" style="width: 72px; height: 72px;">
                            <i class="bi bi-calendar-check feature-icon" style="font-size: 2.5rem;"></i>
                        </div>
                        <h2 class="login-title mb-1">Iniciar sesión</h2>
                        <p class="text-muted">Accede a tu cuenta de Smart Time</p>
                    </div>

<form action="php/login.php" method="POST" class="needs-validation" novalidate>
    
    <div class="mb-4">
        <label for="username" class="form-label text-muted small fw-bold">Usuario o correo</label>
        <input type="text" name="email" class="form-control form-control-custom" id="username"
            placeholder="Ingresa tu usuario o correo" required>
        <div class="invalid-feedback">Por favor, ingresa tu usuario o correo.</div>
    </div>
    
    <div class="mb-4">
        <label for="password" class="form-label text-muted small fw-bold">Contraseña</label>
        <div class="position-relative">
            <input type="password" name="password" class="form-control form-control-custom" id="password"
                placeholder="Ingresa tu contraseña" required>
            <i class="bi bi-eye position-absolute end-0 top-50 translate-middle-y me-3 text-muted"
                style="cursor: pointer;"></i>
            <div class="invalid-feedback">Por favor, ingresa tu contraseña.</div>
        </div>
    </div>

    <div class="d-flex justify-content-between align-items-center mb-5">
        <div class="form-check">
            <input class="form-check-input" type="checkbox" id="rememberMe">
            <label class="form-check-label text-muted small fw-bold" for="rememberMe">
                Recordarme
            </label>
        </div>
        <a href="#" class="text-primary text-decoration-none small fw-bold" data-bs-toggle="modal"
            data-bs-target="#resetPasswordModal">¿Olvidaste tu contraseña?</a>
    </div>

    <button type="submit" class="btn btn-st-primary w-100 mb-4">Iniciar sesión</button>
</form>
                    
                    
                    <div class="modal fade" id="resetPasswordModal" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content p-4" style="border-radius: 20px;">
                                <div class="modal-header border-0">
                                    <h5 class="modal-title fw-bold fs-3">Recuperar Contraseña</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p class="text-muted small">Ingresa tu correo electrónico y te enviaremos las instrucciones para
                                        restablecer tu contraseña de forma local.</p>
                    
                                    <form class="needs-validation" novalidate id="formResetPassword" action="reset_password.php"
                                        method="POST">
                                        <div class="mb-3">
                                            <label class="form-label text-muted small fw-bold">Correo Electrónico</label>
                                            <input type="email" name="reset_email" class="form-control form-control-custom"
                                                placeholder="correo@ejemplo.com" required>
                                            <div class="invalid-feedback">Ingresa el correo asociado a tu cuenta.</div>
                                        </div>
                                        <button type="submit" class="btn btn-st-primary w-100 mt-2">Enviar enlace de recuperación</button>
                                    </form>
                    
                                    <div class="alert alert-success mt-3 d-none" id="resetAlert" role="alert">
                                        <i class="bi bi-check-circle-fill me-2"></i> ¡Enlace enviado! Revisa tu bandeja de entrada simulada.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                        <div class="text-center mb-4">
                            <p class="text-muted small">o continúa con</p>
                            <hr class="w-50 mx-auto mt-2 mb-4">
                        </div>
                        <button type="button" class="btn btn-st-secondary w-100 mb-4" data-bs-toggle="modal"
                            data-bs-target="#registerModal">Registrarse</button>


                        <div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="registerModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content p-4" style="border-radius: 20px;">
                                    <div class="modal-header border-0">
                                        <h5 class="modal-title fw-bold fs-3" id="registerModalLabel">Crear Cuenta</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form class="needs-validation" novalidate id="formRegister" action="php/registro.php" method="POST"
                                            enctype="multipart/form-data">
                                            <div class="mb-3">
                                                <label class="form-label text-muted small fw-bold">Nombre Completo</label>
                                                <input type="text" name="nombre" class="form-control form-control-custom" placeholder="Ej. Juan Pérez"
                                                    required>
                                                <div class="invalid-feedback">Por favor, ingresa tu nombre.</div>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label text-muted small fw-bold">Correo Electrónico</label>
                                                <input type="email" name="email" class="form-control form-control-custom" placeholder="correo@ejemplo.com"
                                                    required>
                                                <div class="invalid-feedback">Ingresa un correo electrónico válido.</div>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label text-muted small fw-bold">Contraseña</label>
                                                <input type="password" name="password" class="form-control form-control-custom" id="regPassword"
                                                    placeholder="Mínimo 6 caracteres" minlength="6" required>
                                                <div class="invalid-feedback">La contraseña debe tener al menos 6 caracteres.</div>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label text-muted small fw-bold">Foto de perfil (.jpg, .jpeg)</label>
                                                <input type="file" name="foto_perfil" class="form-control form-control-custom" accept=".jpg, .jpeg"
                                                    required>
                                                <div class="invalid-feedback">Por favor, selecciona una foto de perfil válida.</div>
                                                <div class="form-text text-muted small">Solo se admiten formatos JPG o JPEG.</div>
                                            </div>
                                            <button type="submit" class="btn btn-st-primary w-100 mt-3">Registrarme en Smart Time</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="text-center text-muted small">
                            <i class="bi bi-shield-check me-1"></i> Tu información está protegida y es confidencial.
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <footer class="py-4 bg-light">
            <div class="container-fluid px-5 d-flex justify-content-between align-items-center">
                <span class="text-muted">© 2024 Smart Time. Todos los derechos reservados.</span>
                <div class="d-flex gap-4">
                    <a href="#" class="text-muted text-decoration-none">Términos de uso</a>
                    <a href="#" class="text-muted text-decoration-none">Política de privacidad</a>
                    <a href="#" class="text-muted text-decoration-none">Ayuda</a>
                </div>
            </div>
        </footer>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>