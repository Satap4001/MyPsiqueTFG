<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a href="/index.php" class="navbar-brand">MyPsique</a>
            <div class="navbar-nav ms-auto">
                <form action="/MyPsiqueTFG/app/views/psicologos/buscar.php" method="post">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="Buscar psicólogos...">
                        <button class="btn btn-outline-secondary" type="submit"><i class="bi bi-search"></i></button>
                    </div>
                </form>
                <?php 
                session_start();
                if (isset($_SESSION['user_id'])) {
                    // Usuario autenticado
                    echo '<a href="../psicologos/perfil.php" class="btn btn-outline-primary me-2">Perfil</a>';
                    echo '<a href="../auth/logout.php" class="btn btn-outline-danger">Cerrar sesión</a>';
                } else {
                    // Usuario no autenticado
                    echo '<a href="../auth/login.php" class="btn btn-outline-primary me-2">Iniciar sesión</a>';
                    echo '<a href="../auth/register.php" class="btn btn-primary">Registrarse</a>';
                }
                ?>
            </div>
        </div>
    </nav>
</header>

<script src="../../../../MyPsiqueTFG/public/script/buscar.js"></script>