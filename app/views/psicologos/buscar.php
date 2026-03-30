<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../public/styles/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../../../public/styles/custom/css/styles.css">

    <title>MyPsique - Buscar Psicólogos</title>

</head>
<body>
    <?php include '../layouts/header.php'; ?>

    <div class="container my-5">
        <h1 class="text-start mb-4">Buscar Psicólogos</h1>
        <?php 
            if ($_SESSION['tipo'] === 'psicologo') {
                echo '<div class="mb-4 text-end">
                        <a href="/MyPsiqueTFG/app/views/psicologos/publicacion.php" class="btn btn-success custom_color_but_anim">
                            <i class="bi bi-plus-lg"></i> Nueva Publicación
                        </a>
                    </div>';
            }
        ?>
        <div>

        </div>
        <div class="input-group mb-4 text-start">
            <input type="text" id="searchInput" class="form-control" placeholder="Buscar por nombre, especialidad o ubicación...">
            <button class="btn btn-primary custom_color_but_anim" type="button">
                <i class="bi bi-search"></i>
            </button>
        </div>

        <div id="results" class="row g-4">
            <!-- Dynamic content will be loaded here -->
        </div>
    </div>

    <?php include '../layouts/footer.php'; ?>

    <script src="../../../public/scripts/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../../../public/scripts/custom/js/search.js"></script>
</body>
</html>