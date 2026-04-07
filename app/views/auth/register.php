<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Regístrate — MyPsique</title>
    <link rel="stylesheet" href="../../../public/styles/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../../../public/styles/custom/css/styles.css">
</head>
<body class="m-0 p-0">
<!-- <?php include_once '../../controllers/AuthController.php'; ?> -->
<div class="d-flex" style="min-height: 100vh;">

    <!-- PANEL IZQUIERDO -->
    <div class="d-none d-md-flex flex-column justify-content-between p-5 col-md-5"
         style="background: linear-gradient(160deg, var(--color-azul-navy) 0%, var(--color-azul-oscuro) 40%, var(--color-azul) 100%);">

        <!-- LOGO -->
        <div class="d-flex align-items-center gap-2">
            <div class="d-flex align-items-center justify-content-center rounded-3"
                 style="background: rgba(255,255,255,0.15); width: 40px; height: 40px;">
                <i class="bi bi-heart-pulse text-white fs-5"></i>
            </div>
            <span class="fw-semibold text-white fs-5"> <a href="../../../../MyPsiqueTFG/public/index.php" class="text-white text-decoration-none">MyPsique</a></span>
        </div>

        <!-- Texto + perks -->
        <div>
            <h2 class="fw-bold text-white mb-3" style="font-size: 1.6rem; line-height: 1.3;">
                Empieza tu camino<br>hacia el bienestar
            </h2>
            <p class="mb-4" style="color: rgba(255,255,255,0.65); font-size: 0.9rem; line-height: 1.7;">
                Crea tu cuenta en menos de 2 minutos y conecta con el psicólogo ideal para ti.
            </p>
            <div class="d-flex flex-column gap-3">
                <div class="d-flex align-items-center gap-3">
                    <div class="d-flex align-items-center justify-content-center rounded-circle flex-shrink-0"
                         style="background: rgba(255,255,255,0.15); width: 30px; height: 30px;">
                        <i class="bi bi-check text-white small"></i>
                    </div>
                    <span style="color: rgba(255,255,255,0.8); font-size: 0.875rem;">Primera sesión de orientación gratuita</span>
                </div>
                <div class="d-flex align-items-center gap-3">
                    <div class="d-flex align-items-center justify-content-center rounded-circle flex-shrink-0"
                         style="background: rgba(255,255,255,0.15); width: 30px; height: 30px;">
                        <i class="bi bi-check text-white small"></i>
                    </div>
                    <span style="color: rgba(255,255,255,0.8); font-size: 0.875rem;">+500 psicólogos verificados</span>
                </div>
                <div class="d-flex align-items-center gap-3">
                    <div class="d-flex align-items-center justify-content-center rounded-circle flex-shrink-0"
                         style="background: rgba(255,255,255,0.15); width: 30px; height: 30px;">
                        <i class="bi bi-check text-white small"></i>
                    </div>
                    <span style="color: rgba(255,255,255,0.8); font-size: 0.875rem;">Sesiones 100% confidenciales</span>
                </div>
                <div class="d-flex align-items-center gap-3">
                    <div class="d-flex align-items-center justify-content-center rounded-circle flex-shrink-0"
                         style="background: rgba(255,255,255,0.15); width: 30px; height: 30px;">
                        <i class="bi bi-check text-white small"></i>
                    </div>
                    <span style="color: rgba(255,255,255,0.8); font-size: 0.875rem;">Disponible desde cualquier dispositivo</span>
                </div>
            </div>
        </div>

        <p style="color: rgba(255,255,255,0.35); font-size: 0.75rem;">© 2024 MyPsique. Todos los derechos reservados.</p>
    </div>

    <!-- PANEL DERECHO CON FORMULARIO -->
    <div class="flex-grow-1 d-flex align-items-center justify-content-center p-4"
         style="background: var(--color-nube);">

        <div class="w-100" style="max-width: 500px;">
            <ul class="nav nav-tabs mb-4" id="registerTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="paciente-tab" data-bs-toggle="tab" data-bs-target="#paciente" type="button" role="tab" aria-controls="paciente" aria-selected="true">
                        Paciente
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="psicologo-tab" data-bs-toggle="tab" data-bs-target="#psicologo" type="button" role="tab" aria-controls="psicologo" aria-selected="false">
                        Psicólogo
                    </button>
                </li>
            </ul>

            <div class="tab-content">
                
                <!-- FORMULARIO PACIENTE -->
                <div class="tab-pane fade show active" id="paciente" role="tabpanel" aria-labelledby="paciente-tab">
                    <div class="card border-0 rounded-4 shadow-sm p-4 p-md-5">
                        <h3 class="fw-bold mb-1" style="color: var(--color-azul-oscuro);">Crea tu cuenta</h3>
                        <p class="mb-4" style="color: var(--color-gris-azul); font-size: 0.9rem;">Rellena los datos para empezar</p>

                        <form id="formPaciente" method="post" action="/MyPsiqueTFG/app/controllers/AuthController.php">
                            
                            <input type="hidden" name="accion" value="registro">
                            <input type="hidden" name="tipo_usuario" value="paciente">
                            <div class="mb-3">
                                <label for="nombre_paciente" class="form-label fw-medium small" style="color: var(--color-gris-azul-medio);">
                                    Nombre completo
                                </label>
                                <input type="text" class="form-control rounded-3" name="nombre" id="nombre_paciente"
                                    placeholder="Tu nombre completo" required
                                    style="border-color: var(--color-gris-azul-claro);">
                            </div>

                            <div class="mb-3">
                                <label for="email_paciente" class="form-label fw-medium small" style="color: var(--color-gris-azul-medio);">
                                    Correo electrónico
                                </label>
                                <input type="email" class="form-control rounded-3" name="email" id="email_paciente"
                                    placeholder="tu@email.com" required
                                    style="border-color: var(--color-gris-azul-claro);">
                            </div>

                            
                            <div class="row g-3 mb-3">
                                <div class="col-12">
                                    <label for="password_paciente" class="form-label fw-medium small" style="color: var(--color-gris-azul-medio);">
                                        Contraseña
                                    </label>
                                    <input type="password" class="form-control rounded-3" name="password" id="password_paciente"
                                        required
                                        style="border-color: var(--color-gris-azul-claro);">
                                </div>
                            </div>

                            
                            <div class="mb-3">
                                <label for="nacionalidad_paciente" class="form-label fw-medium small" style="color: var(--color-gris-azul-medio);">
                                    Nacionalidad
                                </label>
                                <input type="text" class="form-control rounded-3" name="nacionalidad" id="nacionalidad_paciente"
                                    placeholder="Tu nacionalidad" required
                                    style="border-color: var(--color-gris-azul-claro);">
                            </div>

                            
                            <div class="mb-3">
                                <label for="sexo_paciente" class="form-label fw-medium small" style="color: var(--color-gris-azul-medio);">
                                    Sexo
                                </label>
                                <select class="form-select rounded-3" name="sexo" id="sexo_paciente" required
                                    style="border-color: var(--color-gris-azul-claro);">
                                    <option value="">Selecciona tu sexo</option>
                                    <option value="masculino">Masculino</option>
                                    <option value="femenino">Femenino</option>
                                    <option value="otro">Otro</option>
                                </select>
                            </div>

                            
                            <div class="mb-4">
                                <label for="fecha_nacimiento_paciente" class="form-label fw-medium small" style="color: var(--color-gris-azul-medio);">
                                    Fecha de nacimiento
                                </label>
                                <input type="date" class="form-control rounded-3" name="fecha_nacimiento" id="fecha_nacimiento_paciente"
                                    required style="border-color: var(--color-gris-azul-claro);">
                            </div>

                            <button type="submit" class="btn w-100 fw-semibold text-white rounded-3 py-2 mb-3"
                                    style="background: linear-gradient(135deg, var(--color-azul-medio), var(--color-azul));">
                                Crear cuenta gratis
                            </button>
                        </form>
                    </div>
                </div>

                <!-- FORMULARIO PSICÓLOGO -->
                <div class="tab-pane fade" id="psicologo" role="tabpanel" aria-labelledby="psicologo-tab">
                    <div class="card border-0 rounded-4 shadow-sm p-4 p-md-5">
                        <h3 class="fw-bold mb-1" style="color: var(--color-azul-oscuro);">Crea tu cuenta</h3>
                        <p class="mb-4" style="color: var(--color-gris-azul); font-size: 0.9rem;">Rellena los datos para empezar</p>

                        <form id="formPsicologo" method="post" action="/MyPsiqueTFG/app/controllers/AuthController.php">
                            
                            <input type="hidden" name="accion" value="registro">
                            <input type="hidden" name="tipo_usuario" value="psicologo">
                            <div class="mb-3">
                                <label for="nombre_psicologo" class="form-label fw-medium small" style="color: var(--color-gris-azul-medio);">
                                    Nombre completo
                                </label>
                                <input type="text" class="form-control rounded-3" name="nombre" id="nombre_psicologo"
                                    placeholder="Tu nombre completo" required
                                    style="border-color: var(--color-gris-azul-claro);">
                            </div>

                            <div class="mb-3">
                                <label for="email_psicologo" class="form-label fw-medium small" style="color: var(--color-gris-azul-medio);">
                                    Correo electrónico
                                </label>
                                <input type="email" class="form-control rounded-3" name="email" id="email_psicologo"
                                    placeholder="tu@email.com" required
                                    style="border-color: var(--color-gris-azul-claro);">
                            </div>

                            
                            <div class="row g-3 mb-3">
                                <div class="col-12">
                                    <label for="password_psicologo" class="form-label fw-medium small" style="color: var(--color-gris-azul-medio);">
                                        Contraseña
                                    </label>
                                    <input type="password" class="form-control rounded-3" name="password" id="password_psicologo"
                                        required
                                        style="border-color: var(--color-gris-azul-claro);">
                                </div>
                            </div>

                            
                            <div class="mb-3">
                                <label for="nacionalidad_psicologo" class="form-label fw-medium small" style="color: var(--color-gris-azul-medio);">
                                    Nacionalidad
                                </label>
                                <input type="text" class="form-control rounded-3" name="nacionalidad" id="nacionalidad_psicologo"
                                    placeholder="Tu nacionalidad" required
                                    style="border-color: var(--color-gris-azul-claro);">
                            </div>

                            
                            <div class="mb-3">
                                <label for="sexo_psicologo" class="form-label fw-medium small" style="color: var(--color-gris-azul-medio);">
                                    Sexo
                                </label>
                                <select class="form-select rounded-3" name="sexo" id="sexo_psicologo" required
                                    style="border-color: var(--color-gris-azul-claro);">
                                    <option value="">Selecciona tu sexo</option>
                                    <option value="masculino">Masculino</option>
                                    <option value="femenino">Femenino</option>
                                    <option value="otro">Otro</option>
                                </select>
                            </div>

                            
                            <div class="mb-3">
                                <label for="especialidad_psicologo" class="form-label fw-medium small" style="color: var(--color-gris-azul-medio);">
                                    Especialidad
                                </label>
                                <input type="text" class="form-control rounded-3" name="especialidad" id="especialidad_psicologo"
                                    placeholder="Tu especialidad" required
                                    style="border-color: var(--color-gris-azul-claro);">
                            </div>

                            
                            <div class="mb-3">
                                <label for="fecha_nacimiento_paciente" class="form-label fw-medium small" style="color: var(--color-gris-azul-medio);">
                                    Fecha de nacimiento
                                </label>
                                <input type="date" class="form-control rounded-3" name="fecha_nacimiento" id="fecha_nacimiento_paciente"
                                    required style="border-color: var(--color-gris-azul-claro);">
                            </div>

                            
                            <div class="mb-4">
                                <label for="telefono" class="form-label fw-medium small" style="color: var(--color-gris-azul-medio);">
                                    Teléfono
                                </label>
                                <input type="tel" class="form-control rounded-3" name="telefono" id="telefono"
                                    placeholder="Tu teléfono" required
                                    style="border-color: var(--color-gris-azul-claro);">
                            </div>

                            <button type="submit" class="btn w-100 fw-semibold text-white rounded-3 py-2 mb-3"
                                    style="background: linear-gradient(135deg, var(--color-azul-medio), var(--color-azul));">
                                Crear cuenta gratis
                            </button>
                        </form>
                    </div>
                </div>

            </div>

            <div class="d-flex align-items-center gap-2 my-3">
                <hr class="flex-grow-1 m-0" style="border-color: var(--color-nube-dark);">
                <span class="small" style="color: var(--color-gris-azul-claro);">o</span>
                <hr class="flex-grow-1 m-0" style="border-color: var(--color-nube-dark);">
            </div>

            <p class="text-center mb-0 small" style="color: var(--color-gris-azul);">
                ¿Ya tienes cuenta?
                <a href="login.php" class="fw-medium" style="color: var(--color-azul);">Inicia sesión</a>
            </p>
        </div>
    </div>

</div>

<script src="../../../public/styles/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>