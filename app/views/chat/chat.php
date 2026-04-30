<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mensajes | MyPsique</title>
    <link rel="stylesheet" href="/MyPsiqueTFG/public/styles/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="/My">
    
</head>
<body>
    <?php include '../layouts/header.php';  ?>

    <div class="container my-5">
        <h1 class="text-center mb-4">Mensajes</h1>
    </div>

    <?php include '../layouts/footer.php';  ?>
    <script>
        var eventSource = new EventSource('/MyPsiqueTFG/app/controllers/ChatController.php');
        eventSource.onmessage = function(event) {
            console.log('Nuevo mensaje:', event.data);
            // Aquí puedes agregar lógica para actualizar la interfaz de usuario con el nuevo mensaje
        };

    
    </script>
</body>
</html>