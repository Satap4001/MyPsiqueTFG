<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="styles/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="styles/custom/css/styles.css">
</head>
<body style="margin: 0; padding: 0;">

    <?php include '../app/views/layouts/header.php'; ?>


    <div class="d-flex justify-content-center align-items-center" 
         style="min-height: 65vh; width: 100%; background: linear-gradient(to bottom, var(--color-azul), var(--color-gris-azul), var(--color-nube));">
        <div class="text-center">
            <span class="d-inline-block mb-3" style="font-size: 3rem; color: var(--color-azul);">
                <i class="bi bi-emoji-smile"></i>
            </span>
            <h1 class="mb-3">Bienvenido a MyPsique</h1>
            <h4 class="mb-3 text-secondary">Cuidar tu salud mental nunca fue tan fácil</h4>
            <p class="mb-4">Estamos aquí para acompañarte en tu bienestar emocional, estés donde estés.</p>
            <a href="auth/register.php" class="btn btn-primary btn-lg me-2">Regístrate gratis</a>
            <a href="auth/login.php" class="btn btn-outline-primary btn-lg">Iniciar sesión</a>
        </div>
    </div>

     <section class="py-5" style="background: var(--color-nube);">
        <div class="container text-center">
            <p class="text-uppercase fw-bold small mb-1" style="color: var(--color-azul); letter-spacing: 0.1em;">¿Por qué MyPsique?</p>
            <h2 class="fw-bold mb-1" style="color: var(--color-azul-oscuro);">Todo lo que necesitas</h2>
            <p class="text-secondary mb-5">Una plataforma pensada para ti</p>
            <div class="row g-4 justify-content-center">
                <div class="col-md-4">
                    <div class="card border-0 rounded-4 shadow-sm h-100 p-4">
                        <div class="mb-3 d-inline-flex align-items-center justify-content-center rounded-3" style="background: #EBF4FE; padding: 0.5em;">
                            <i class="bi bi-person-heart fs-4" style="color: var(--color-azul);"></i>
                        </div>
                        <h5 class="fw-semibold" style="color: var(--color-azul-oscuro);">Atención personalizada</h5>
                        <p class="text-secondary small mb-0">Psicólogos adaptados a tus necesidades y ritmo de vida.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card border-0 rounded-4 shadow-sm h-100 p-4">
                        <div class="mb-3 d-inline-flex align-items-center justify-content-center rounded-3" 
     style="background: #EBF4FE; padding: 0.5em;">
                            <i class="bi bi-shield-lock fs-4" style="color: var(--color-azul);"></i>
                        </div>
                        <h5 class="fw-semibold" style="color: var(--color-azul-oscuro);">100% confidencial</h5>
                        <p class="text-secondary small mb-0">Tus sesiones y datos están protegidos con los más altos estándares.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card border-0 rounded-4 shadow-sm h-100 p-4">
                        <div class="mb-3 d-inline-flex align-items-center justify-content-center rounded-3" 
     style="background: #EBF4FE; padding: 0.5em;">
                            <i class="bi bi-laptop fs-4" style="color: var(--color-azul);"></i>
                        </div>
                        <h5 class="fw-semibold" style="color: var(--color-azul-oscuro);">Flexible y accesible</h5>
                        <p class="text-secondary small mb-0">Sesiones desde casa, sin desplazamientos ni listas de espera.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- Sección 1: Texto izquierda, imagen derecha -->
    <div class="container my-5">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h2>Atención personalizada</h2>
                <p>Conecta con psicólogos profesionales que te acompañarán en tu proceso de bienestar emocional, adaptándose a tus necesidades.</p>
            </div>
            <div class="col-md-6 text-center">
                <img src="img/atencion.png" alt="Atención personalizada" class="img-fluid rounded shadow">
            </div>
        </div>
    </div>

    <!-- Sección 2: Imagen izquierda, texto derecha -->
    <div class="container my-5">
        <div class="row align-items-center flex-row-reverse">
            <div class="col-md-6">
                <h2>Confidencialidad y seguridad</h2>
                <p>Tus datos y sesiones están protegidos bajo estrictos estándares de privacidad, garantizando un espacio seguro para ti.</p>
            </div>
            <div class="col-md-6 text-center">
                <img src="img/confidencialidad.png" alt="Confidencialidad y seguridad" class="img-fluid rounded shadow">
            </div>
        </div>
    </div>

    <!-- Sección 3: Texto izquierda, imagen derecha -->
    <div class="container my-5">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h2>Acceso desde cualquier lugar</h2>
                <p>Realiza tus sesiones desde la comodidad de tu hogar o donde prefieras, sin barreras geográficas ni de horario.</p>
            </div>
            <div class="col-md-6 text-center">
                <img src="img/online.png" alt="Acceso desde cualquier lugar" class="img-fluid rounded shadow">
            </div>
        </div>
    </div>



    <?php include '../app/views/layouts/footer.php'; ?>

</body>
</html>