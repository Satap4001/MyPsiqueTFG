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

<body style="margin: 0; padding: 0; background: var(--color-nube);">
    <?php include '../layouts/header.php';  ?>
    <?php  ?>
    <?php
    if (!isset($_SESSION['user_id']) || $_SESSION['nombre'] == '' || !isset($_SESSION['nombre'])) {
        header('Location: /MyPsiqueTFG/public/index.php');
        exit();
    }
    ?>

    

    <div class="container fs-6">
        <div class="row text-center">
            
            <div class="col-2 font-weight-bold ">
                Perfil de <?php echo $_SESSION['nombre']; ?>

            </div>
            
        </div>

    </div>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body text-center">
                        <i class="bi bi-person-circle" style="font-size: 80px; color: var(--color-primary);"></i>
                        <h5 class="card-title mt-3"><?php echo $_SESSION['nombre']; ?></h5>
                        <?php 
                        $usuario = Usuario::findByName($_GET['nombre']);
                        if ($_SESSION['user_id'] === $usuario['id']): ?>
                            <a href="modPerfil.php" class="btn btn-primary btn-sm">Editar Perfil</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h5>Información Personal</h5>
                    </div>
                    <div class="card-body">
                        <p><strong>Email:</strong> usuario@example.com</p>
                        <?php
                        
                        if($_SESSION['tipo'] === 'psicologo'): ?>    <p><strong>Especialidad:</strong> Psicología Clínica</p>
                        <?php endif; ?>
                        <p><strong>Bio:</strong> Descripción del usuario aquí</p>
                    </div>
                </div>
                <div class="card mt-3">
                    <div class="card-header">
                        <h5>Estadísticas</h5>
                    </div>
                    <div class="card-body">
                        <p><strong>Miembro desde:</strong> Enero 2024</p>
                        <p><strong>Pacientes:</strong> 15</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        
    </script>



</body>

</html>