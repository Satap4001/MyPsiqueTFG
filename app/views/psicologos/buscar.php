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
                echo '<button type="button"
                    class="btn btn-success"
                    data-bs-toggle="modal"
                    data-bs-target="#modalPublicacion">
                    <i class="bi bi-plus-lg"></i> Nueva Publicación
                </button>';
            }
        ?>

        <!-- MODAL PARA NUEVA PUBLICACIÓN -->

        <div class="modal fade" id="modalPublicacion" tabindex="-1" aria-labelledby="modalPublicacionLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalPublicacionLabel">Nueva Publicación</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="formPublicacion" action="/MyPsiqueTFG/app/controllers/PublicacionController.php" method="POST">
                            <input type="hidden" name="user_id" value="<?= $_SESSION['user_id'] ?>">
                            <div class="mb-3">
                                <label for="titulo" class="form-label">Título</label>
                                <input type="text" class="form-control" id="titulo" name="titulo" placeholder="Título..." required>
                            </div>
                            <div class="mb-3">
                                <label for="contenido" class="form-label">Descripción</label>
                                <textarea class="form-control" id="contenido" name="contenido" rows="4" placeholder="Descripción..." required></textarea>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" form="formPublicacion" class="btn btn-primary">Publicar</button>
                    </div>
                </div>
            </div>
        </div>

        <div>

        </div>
        <div class="input-group mb-4 text-start">
            <input type="text" id="searchInput" class="form-control" placeholder="Buscar por nombre, especialidad o ubicación...">
            <button class="btn btn-primary custom_color_but_anim" type="button">
                <i class="bi bi-search"></i>
            </button>
        </div>

        <div id="results" class="row g-4">
            
        </div>
    </div>

    <?php include '../layouts/footer.php'; ?>
    <script>

        
        document.addEventListener('DOMContentLoaded', function () {
            const resultsContainer = document.getElementById('results');
            const searchInput = document.getElementById('searchInput');
            //QUERY '' HACE QUE SI NO SE BUSCA POR NADA , TE DA TODAS LAS PUBLICACIONES
            function loadPublicaciones(query = '') {
                fetch(`/MyPsiqueTFG/app/controllers/PublicacionController.php?action=getPublicaciones`)
                    .then(response => response.json())
                    .then(data => {
                        resultsContainer.innerHTML = ''; 
                        data.forEach(publicacion => {
                            if (publicacion.titulo.toLowerCase().includes(query.toLowerCase()) || 
                                publicacion.contenido.toLowerCase().includes(query.toLowerCase())) {
                                const card = `
                                    <div class="col-md-4">
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title">${publicacion.titulo}</h5>
                                                <p class="card-text">${publicacion.descripcion}</p>
                                            </div>
                                        </div>
                                    </div>
                                `;
                                resultsContainer.innerHTML += card;
                            }
                        });
                    })
                    .catch(error => console.error('Error al cargar publicaciones:', error));
            }

            
            loadPublicaciones();

            
            searchInput.addEventListener('input', function () {
                loadPublicaciones(this.value);
            });
        });


    </script>
    <script src="../../../public/scripts/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../../../public/scripts/custom/js/search.js"></script>
</body>
</html>