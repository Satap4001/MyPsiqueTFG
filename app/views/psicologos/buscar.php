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
            if (isset($_SESSION['tipo'])){

                if ($_SESSION['tipo'] === 'psicologo') {
                    echo '<button type="button"
                        class="btn btn-success"
                        data-bs-toggle="modal"
                        data-bs-target="#modalPublicacion">
                        <i class="bi bi-plus-lg"></i> Nueva Publicación
                    </button>';
                }

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
                        <form id="formPublicacion" action="/MyPsiqueTFG/app/controllers/PublicacionController.php" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="user_id" value="<?= $_SESSION['user_id'] ?>">
                            <div class="mb-3">
                                <label for="titulo" class="form-label">Título</label>
                                <input type="text" class="form-control" id="titulo" name="titulo" placeholder="Título..." required>
                            </div>
                            <div class="mb-3">
                                <label for="contenido" class="form-label">Descripción</label>
                                <textarea class="form-control" id="contenido" name="contenido" rows="4" placeholder="Descripción..." required></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="imagen1" class="form-label">Imagen 1</label>
                                <input type="file" class="form-control" id="imagen1" name="imagen1">
                            </div>
                            <div class="mb-3">
                                <label for="imagen2" class="form-label">Imagen 2</label>
                                <input type="file" class="form-control" id="imagen2" name="imagen2">
                            </div>
                            <div class="mb-3">
                                <label for="imagen3" class="form-label">Imagen 3</label>
                                <input type="file" class="form-control" id="imagen3" name="imagen3">
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
        <!-- BUSQUEDA POR FILTROS -->    
        <div >

            <button type="button"
                        class="btn btn-success"
                        data-bs-toggle="modal"
                        data-bs-target="#modalFiltros">
                        <i class="bi bi-funnel"></i> Filtrar
            </button>

        </div>


        <!-- MODAL QUE APARECE POR FILTROS -->

        <div class="modal fade" id="modalFiltros" tabindex="-1" aria-labelledby="modalFiltrosLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title" id="modalFiltrosLabel">Filtrar Publicaciones</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form id="filtro" action="/MyPsiqueTFG/app/controllers/PublicacionController.php" method="GET">
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="Psicologo" class="form-label">Psicólogo</label>
                                <input type="text" class="form-control" name="Psicologo" placeholder="Escribe el nombre del psicólogo...">
                            </div>
                            <div class="mb-3">
                                <label for="Titulo" class="form-label">Título</label>
                                <input type="text" class="form-control" name="Titulo" placeholder="Escribe el título...">
                            </div>
                            <div class="mb-3">
                                <label for="Descripcion" class="form-label">Descripción</label>
                                <input type="text" class="form-control" name="Descripcion" placeholder="Escribe la descripción...">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Rango de Precio del psicólogo</label>
                                </label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="rangoPrecio" id="precio1" value="0-50">
                                    <label class="form-check-label" for="precio1">0-50€</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="rangoPrecio" id="precio2" value="50-100">
                                    <label class="form-check-label" for="precio2">50-100€</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="rangoPrecio" id="precio3" value="100-150">
                                    <label class="form-check-label" for="precio3">100-150€</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="rangoPrecio" id="precio4" value="150+">
                                    <label class="form-check-label" for="precio4">150€ o más</label>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar y buscar</button>
                            <button type="reset" class="btn btn-warning">Borrar filtros</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div id="results" class="row g-4">
            
        </div>
    </div>

    <?php include '../layouts/footer.php'; ?>
    <script>

        
        document.addEventListener('DOMContentLoaded', function () {
        const resultsContainer = document.getElementById('results');
        const filtroForm = document.getElementById('filtro');
        // SE BUSCA SIN FILTROS AL CARGAR
        // EN CASO DE QUE SE USE EL FORMULARIO DE FILTROS, SE CARGA LOS FILTROS CON 
        function loadPublicaciones(filtros = {}) {
            
            const queryParams = new URLSearchParams();
            
            if (filtros.Psicologo) queryParams.append('Psicologo', filtros.Psicologo);
            if (filtros.Titulo) queryParams.append('Titulo', filtros.Titulo);
            if (filtros.Descripcion) queryParams.append('Descripcion', filtros.Descripcion);
            if (filtros.rangoPrecio) queryParams.append('rangoPrecio', filtros.rangoPrecio);
            // SI NO HAY FILTROS, SE CARGA TODO EN EL IF TERNARIO
            const url = `/MyPsiqueTFG/app/controllers/PublicacionController.php${queryParams.toString() ? '?' + queryParams.toString() : ''}`;

            fetch(url)
                .then(response => response.json())
                .then(data => {
                    resultsContainer.innerHTML = ''; 
                    
                    if (data.length === 0) {
                        resultsContainer.innerHTML = '<p class="text-center">No se encontraron publicaciones</p>';
                        return;
                    }

                    data.forEach(publicacion => { <?php ?>
                        const card = `
                            <div class="col-md-12">
                                <div class="card border-0 rounded-4 shadow-sm overflow-hidden">
                                    <!-- Header con Avatar y Info del Psicólogo -->
                                    <div class="card-header bg-light border-0 p-4">
                                        <div class="d-flex align-items-center gap-3">
                                            
                                            <div class="position-relative">
                                                <img src="/MyPsiqueTFG/app/uploads/avatar/${publicacion.avatar || 'default.png'}" 
                                                    alt="${publicacion.nombre}" 
                                                    class="rounded-circle"
                                                    style="width: 60px; height: 60px; object-fit: cover; border: 3px solid var(--color-azul);">
                                            </div>
                                            
                                            
                                            <div class="flex-grow-1">
                                                <h6 class="mb-0">
                                                    <a href="/MyPsiqueTFG/app/views/dashboard/perfil.php?user_id=${publicacion.user_id}" 
                                                    class="text-decoration-none fw-bold"
                                                    style="color: var(--color-azul-oscuro); transition: color 0.3s;">
                                                        ${publicacion.nombre}
                                                    </a>
                                                </h6>
                                                <small class="text-muted">${publicacion.especialidad || 'Psicólogo'}</small>
                                                <br>
                                                <small class="text-secondary" style="font-size: 0.8rem;">
                                                    <i class="bi bi-calendar-event"></i> ${new Date(publicacion.fecha_creacion).toLocaleDateString('es-ES')}
                                                </small>
                                            </div>

                                            <!-- Rating (opcional) -->
                                            <div class="text-end">
                                                <div class="text-warning">
                                                    <i class="bi bi-star-fill"></i>
                                                    <span class="fw-bold text-dark">${publicacion.calificacion || '4.8'}</span>
                                                </div>
                                                <small class="text-muted">(${publicacion.num_resenas || '0'} reseñas)</small>
                                            </div>
                                        </div>
                                    </div>

                                    
                                    <div class="card-body p-4">
                                        
                                        <h5 class="card-title fw-bold mb-2" style="color: var(--color-azul-oscuro);">
                                            ${publicacion.titulo}
                                        </h5>

                                        <!-- Descripción -->
                                        <p class="card-text text-secondary mb-3" style="line-height: 1.6;">
                                            ${publicacion.descripcion}
                                        </p>

                                        
                                        <div class="mb-3">
                                            <div class="row g-2">
                                                ${publicacion.codigoImagen1 ? `
                                                    <div class="col-md-6">
                                                        <img src="/MyPsiqueTFG/app/uploads/${publicacion.codigoImagen1}" 
                                                            class="img-fluid rounded-3 shadow-sm" 
                                                            style="cursor: pointer; transition: transform 0.3s;"
                                                            onclick="abrirImagenModal(this.src)">
                                                    </div>
                                                ` : ''}
                                                ${publicacion.codigoImagen2 ? `
                                                    <div class="col-md-6">
                                                        <img src="/MyPsiqueTFG/app/uploads/${publicacion.codigoImagen2}" 
                                                            class="img-fluid rounded-3 shadow-sm"
                                                            style="cursor: pointer; transition: transform 0.3s;"
                                                            onclick="abrirImagenModal(this.src)">
                                                    </div>
                                                ` : ''}
                                                ${publicacion.codigoImagen3 ? `
                                                    <div class="col-md-12">
                                                        <img src="/MyPsiqueTFG/app/uploads/${publicacion.codigoImagen3}" 
                                                            class="img-fluid rounded-3 shadow-sm"
                                                            style="cursor: pointer; transition: transform 0.3s;"
                                                            onclick="abrirImagenModal(this.src)">
                                                    </div>
                                                ` : ''}
                                            </div>
                                        </div>
                                    </div>

                                    
                                    <div class="card-footer bg-light border-top p-3 d-flex gap-2 justify-content-between">
                                        <!-- Likes -->
                                        <div class="d-flex align-items-center gap-2">
                                            <button class="btn btn-sm btn-light border-0" onclick="darLike(${publicacion.id})">
                                                <i class="bi bi-heart" style="color: var(--color-azul);"></i>
                                                <span class="small text-muted">${publicacion.likes || 0}</span>
                                            </button>
                                        </div>

                                        
                                        <div class="d-flex gap-2">
                                            <button class="btn btn-sm btn-outline-primary rounded-3">
                                                <i class="bi bi-chat-dots"></i> Contactar
                                            </button>
                                            <button class="btn btn-sm btn-primary rounded-3">
                                                <i class="bi bi-calendar-check"></i> Agendar
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        `;
                        resultsContainer.innerHTML += card;
                    });
                })
                .catch(error => console.error('Error al cargar publicaciones:', error));
        }

        
        loadPublicaciones();

        // FILTRAR PUBLICACIONES
        filtroForm.addEventListener('change', function () {
            const formData = new FormData(filtroForm);
            const filtros = Object.fromEntries(formData);
            
           
            Object.keys(filtros).forEach(key => {
                if (!filtros[key]) delete filtros[key];
            });
            
            loadPublicaciones(filtros);
        });

        // RESETEAR FILTROS
        filtroForm.addEventListener('reset', function () {
            setTimeout(() => {
                loadPublicaciones();
            }, 0);
        });
    });


    </script>
    <script src="../../../public/scripts/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../../../public/scripts/custom/js/search.js"></script>
</body>
</html>