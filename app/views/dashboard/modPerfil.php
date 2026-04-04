<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar perfil | MyPSique</title>
</head>
<body>
    <?php include '../layouts/header.php';  ?>
    <div class="container my-5">
        <h1 class="text-center mb-4">Modificar Perfil</h1>
        <form action="/MyPsiqueTFG/app/controllers/UsuarioController.php" method="POST">
            <input type="hidden" name="action" value="update">
            <input type="hidden" name="id" value="<?= $_SESSION['user_id'] ?>">
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre" value="<?= $_SESSION['nombre'] ?>" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?= $_SESSION['email'] ?>" required>
            </div>
            
            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
        </form>
    </div>
    <?php include '../layouts/footer.php';  ?>
</body>
</html>