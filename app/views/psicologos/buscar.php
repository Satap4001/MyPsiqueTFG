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

    <h1 class="my-4">Buscar Psicólogos</h1>

    <div class="mb-4">
        <input type="text" id="searchInput" class="form-control" placeholder="Buscar por nombre, especialidad o ubicación...">
    </div>

    <div id="results" class="row g-4">
        <?php ?>
    </div>

    <?php include '../layouts/footer.php'; ?>

    <script src="../../../public/scripts/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../../../public/scripts/custom/js/search.js"></script>
</body>
</html>