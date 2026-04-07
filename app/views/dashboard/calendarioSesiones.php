<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendario de Sesiones | MyPsique</title>
    <link rel="stylesheet" href="../../../public/styles/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../../public/styles/custom/css/styles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body>
        <?php include '../layouts/header.php';  ?>
    <div>
        

        <div class="container my-5">
            <h1 class="text-center mb-4">Calendario de Sesiones</h1>
        </div>

        <?php if ($_SESSION['tipo'] === 'psicologo'): ?>
            
        <?php endif; ?>


        
            
    </div>
        <?php include '../layouts/footer.php';  ?>
</body>
</html>