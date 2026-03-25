<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar sesión — MyPsique</title>
    <link rel="stylesheet" href="../../../public/styles/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../../../public/styles/custom/css/styles.css">
</head>
<body class="m-0 p-0">

<div class="d-flex" style="min-height: 100vh;">

    <!-- Panel izquierdo decorativo -->
    <div class="d-none d-md-flex flex-column justify-content-between p-5 col-md-5"
         style="background: linear-gradient(160deg, var(--color-azul-navy) 0%, var(--color-azul-oscuro) 40%, var(--color-azul) 100%);">

        <!-- Logo -->
        <div class="d-flex align-items-center gap-2">
            <div class="d-flex align-items-center justify-content-center rounded-3 p-2"
                 style="background: rgba(255,255,255,0.15); width: 40px; height: 40px;">
                <i class="bi bi-heart-pulse text-white fs-5"></i>
            </div>
            <span class="fw-semibold text-white fs-5">MyPsique</span>
        </div>

        <!-- Texto central -->
        <div>
            <h2 class="fw-bold text-white mb-3" style="font-size: 1.8rem; line-height: 1.3;">
                Tu salud mental,<br>en buenas manos
            </h2>
            <p style="color: rgba(255,255,255,0.65); font-size: 0.9rem; line-height: 1.7;">
                Conecta con psicólogos profesionales desde donde estés, cuando lo necesites.
            </p>
        </div>

        <!-- Stats -->
        <div class="d-flex gap-3">
            <div class="rounded-3 p-3" style="background: rgba(255,255,255,0.1); border: 1px solid rgba(255,255,255,0.15);">
                <div class="fw-bold text-white">+500</div>
                <div style="font-size: 11px; color: rgba(255,255,255,0.6);">Psicólogos</div>
            </div>
            <div class="rounded-3 p-3" style="background: rgba(255,255,255,0.1); border: 1px solid rgba(255,255,255,0.15);">
                <div class="fw-bold text-white">98%</div>
                <div style="font-size: 11px; color: rgba(255,255,255,0.6);">Satisfacción</div>
            </div>
            <div class="rounded-3 p-3" style="background: rgba(255,255,255,0.1); border: 1px solid rgba(255,255,255,0.15);">
                <div class="fw-bold text-white">24/7</div>
                <div style="font-size: 11px; color: rgba(255,255,255,0.6);">Disponible</div>
            </div>
        </div>
    </div>

    <!-- Panel derecho con formulario -->
    <div class="flex-grow-1 d-flex align-items-center justify-content-center p-4"
         style="background: var(--color-nube);">
        <div class="card border-0 rounded-4 shadow-sm p-4 p-md-5" style="width: 100%; max-width: 400px;">

            <h3 class="fw-bold mb-1" style="color: var(--color-azul-oscuro);">Bienvenido de nuevo</h3>
            <p class="mb-4" style="color: var(--color-gris-azul); font-size: 0.9rem;">Inicia sesión en tu cuenta</p>

            <form class="login-form" method="POST" action="/MyPsiqueTFG/app/controllers/AuthController.php">
                <input type="hidden" name="accion" value="login">
                <div class="mb-3">
                    <label for="email" class="form-label fw-medium small" style="color: var(--color-gris-azul-medio);">
                        Correo electrónico
                    </label>
                    <input type="email" class="form-control rounded-3" name="email" id="email"
                           placeholder="tu@email.com" required
                           style="border-color: var(--color-gris-azul-claro);">
                </div>

                <div class="mb-1">
                    <div class="d-flex justify-content-between align-items-center">
                        <label for="password" class="form-label fw-medium small mb-0" style="color: var(--color-gris-azul-medio);">
                            Contraseña
                        </label>
                        <a href="#" class="small" style="color: var(--color-azul);">¿Olvidaste tu contraseña?</a>
                    </div>
                </div>
                <div class="mb-4">
                    <input type="password" class="form-control rounded-3" name="password" id="password"
                           placeholder="••••••••" required
                           style="border-color: var(--color-gris-azul-claro);">
                </div>

                <button type="submit" class="btn w-100 fw-semibold text-white rounded-3 py-2 mb-3"
                        style="background: linear-gradient(135deg, var(--color-azul-medio), var(--color-azul));">
                    Iniciar sesión
                </button>
            </form>

            <div class="d-flex align-items-center gap-2 my-3">
                <hr class="flex-grow-1 m-0" style="border-color: var(--color-nube-dark);">
                <span class="small" style="color: var(--color-gris-azul-claro);">o</span>
                <hr class="flex-grow-1 m-0" style="border-color: var(--color-nube-dark);">
            </div>

            <p class="text-center mb-0 small" style="color: var(--color-gris-azul);">
                ¿No tienes cuenta?
                <a href="register.php" class="fw-medium" style="color: var(--color-azul);">Regístrate gratis</a>
            </p>
        </div>
    </div>

</div>

</body>
</html>