<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar perfil | MyPSique</title>
    <link rel="stylesheet" href="../../../public/styles/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../../../public/styles/custom/css/styles.css">
    
</head>
<body>

    <?php include '../layouts/header.php';?>
   
    <div class="container my-5">
        <h1 class="text-center mb-4">Modificar Perfil</h1>
        <form action="/MyPsiqueTFG/app/controllers/UsuarioController.php ?>" method="POST" enctype="multipart/form-data">
            <input type="hidden" value="update" id="action">
            <input type="hidden" name="action" value="update">
            <input type="hidden" name="id" value="<?= $_SESSION['user_id'] ?>">
            <div class="row">
                <div class="col-6">
                    <label for="nombre">Nombre</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" value="<?= $_SESSION['nombre'] ?>" readonly required>
                </div>
                <div class="col-6 " rowspan="2">
                    <label for="avatar">Avatar</label>
                    <input type="file" class="form-control" id="avatar" name="avatar">
                </div>
                <div class="col-6">
                    <label for="correo">Correo</label>
                    <input type="email" class="form-control" id="correo" name="email" value="<?= $_SESSION['email'] ?>" required>
                </div>
                <?php if ($_SESSION['tipo'] === 'psicologo') : ?>
                    <div class="col-6">
                        <label for="telefono">Teléfono</label>
                        <input type="text" class="form-control" id="telefono" name="telefono" value="<?= $_SESSION['telefono'] ?>" >
                    </div>
                <?php endif; ?>

            </div>
            
            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
        </form>
    </div>
    <?php include '../layouts/footer.php';  ?>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            
            const avatarInput = document.getElementById('avatar');
            const avatarPreview = document.createElement('img');
            avatarPreview.style.maxWidth = '150px';
            avatarPreview.style.marginTop = '10px';
            avatarInput.parentNode.appendChild(avatarPreview);

            avatarInput.addEventListener('change', function() {
                const file = this.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        avatarPreview.src = e.target.result;
                    }
                    reader.readAsDataURL(file);
                } else {
                    avatarPreview.src = '';
                }
            });
        });
    </script>
</body>
</html>