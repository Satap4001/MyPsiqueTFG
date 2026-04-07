<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comunidad</title>
    <link rel="stylesheet" href="../../../public/styles/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../../../public/styles/custom/css/styles.css">
</head>
<body>
    <?php include '../layouts/header.php'; ?>

    <div id="publicaciones"></div>
    
    <?php include '../layouts/footer.php'; ?>

    <script>
        $(document).ready(function() {
            loadPublicaciones();
            
            function loadPublicaciones() {
                $.ajax({
                    url: '../../controllers/PublicacionController.php',
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        displayPublicaciones(data);
                    },
                    error: function(err) {
                        console.log('Error loading publicaciones:', err);
                    }
                });
            }
            
            function displayPublicaciones(publicaciones) {
                let html = '';
                publicaciones.forEach(function(pub) {
                    html += `<div class="publicacion">
                                <h3>${pub.titulo}</h3>
                                <p>${pub.descripcion}</p>
                                <small>${pub.fecha}</small>
                            </div>`;
                });
                $('#publicaciones').html(html);
            }
        });
    </script>
</body>
</html>