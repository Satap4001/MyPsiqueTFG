<?php
session_start();

// Definimos el directorio base (ajustado para `public/`)
$base_url = '/MyPsiqueTFG';
?>
<link rel="stylesheet" href="<?= $base_url ?>/public/styles/custom/css/styles.css">

<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <!-- LOGO CON LINK INDEX -->
            <a href="<?= $base_url ?>/public/index.php" class="navbar-brand">MyPsique</a>

            <!-- TEXTO DROPDOWN -->
            <div class="navbar-nav mx-auto">
                <div class="d-flex gap-3">
                    <div class="dropdown">
                        <button class="btn dropdown-toggle nav_buton" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Sobre Nosotros
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item nav_buton" href="<?= $base_url ?>/app/views/about/contact.php">Contacto</a></li>
                            <li><a class="dropdown-item nav_buton" href="<?= $base_url ?>/app/views/about/aboutUs.php">Quiénes somos</a></li>
                        </ul>
                    </div>

                    <div class="dropdown">
                        <button class="btn dropdown-toggle nav_buton" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Psicólogos
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item nav_buton" href="#">Nuestros Psicólogos</a></li>
                            <li><a class="dropdown-item nav_buton" href="<?= $base_url ?>/app/views/psicologos/comunidad.php">Comunidad</a></li>
                            <li><a class="dropdown-item nav_buton" href="#">Trabaja con nosotros</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- PERFIL/ SESION -->
            <div class="d-flex justify-content-end align-items-center">
                <?php 
                if (isset($_SESSION['user_id'])) {
                    // Usuario autenticado
                    echo '
                        <div class="dropdown">
                            <button class="btn dropdown-toggle nav_buton" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Mi Cuenta
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item nav_buton" href="' . $base_url . '/app/views/dashboard/perfil.php?user_id=' . $_SESSION['user_id'] . '">Mi Perfil</a></li>
                                <li><a class="dropdown-item nav_buton" href="' . $base_url . '/app/views/dashboard/modPerfil.php">Modificar Cuenta</a></li>
                                <li><a class="dropdown-item nav_buton" href="' . $base_url . '/app/views/auth/logout.php">Cerrar sesión</a></li>
                            </ul>
                        </div>
                    ';
                    
                } else {
                    // Usuario no autenticado
                    echo '<a href="' . $base_url . '/app/views/auth/login.php" class="btn btn-outline-primary me-2">Iniciar sesión</a>';
                    echo '<a href="' . $base_url . '/app/views/auth/register.php" class="btn btn-primary">Registrarse</a>';
                }
                ?>
            </div>
        </div>
    </nav>
    <script src="<?= $base_url ?>/public/styles/bootstrap/js/bootstrap.bundle.min.js"></script>
</header>

