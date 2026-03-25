<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../public/styles/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../../../public/styles/custom/css/styles.css">
    <title>Document</title>
</head>
<body style="margin: 0; padding: 0;">
    <?php include '../layouts/header.php';  ?>
    <?php
        if (!isset($_SESSION['user_id']) || $_SESSION['nombre'] == '' || !isset($_SESSION['nombre'])) {
            header('Location: /MyPsiqueTFG/public/index.php');
            exit();
        }
    ?>
    
    <div class="row" style="background: var(--color-nube); min-height: 80vh; margin: 0; padding: 0; ">
        <div class="col-2" style="background: var(--color-nube);">
            Perfil de <?php echo $_SESSION['nombre']; ?>

        </div>
        <div class="col-8" style="background: var(--color-nube);">
            Perfil de <?php echo $_SESSION['nombre']; ?>

        </div>
        <div class="col-2" style="background: var(--color-nube);">
            Perfil de <?php echo $_SESSION['nombre']; ?>

        </div>
        
    </div>



</body>
</html>