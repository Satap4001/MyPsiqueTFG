<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Perfil</title>
    <link rel="stylesheet" href="/MyPsiqueTFG/public/styles/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="/MyPsiqueTFG/public/styles/custom/css/styles.css">
</head>
<body>
    <?php include '../layouts/header.php'; ?>

<div class="container mt-5">
    <div class="row" id="perfil-container">
        <p class="text-muted">Cargando perfil...</p>
    </div>
</div>

    

    <?php include '../layouts/footer.php'; ?>
<script>
const slug = window.location.pathname.split('/').pop(); 
const user_id = slug.split('-').pop(); 

fetch(`/MyPsiqueTFG/app/controllers/PerfilController.php?user_id=${user_id}`)
    .then(res => {
        if (!res.ok) throw new Error('Usuario no encontrado');
        console.log(res);
        return res.json();
    })
    .then(data => {
        let html = `
            
            <div class="col-md-4 px-3">
                <div class="card text-dark sticky-top" style="top: 20px;">
                    <div class="card-body text-center">
                        <img src="/MyPsiqueTFG/app/uploads/avatar/${data.avatar || 'default.png'}" 
                             alt="${data.nombre}" 
                             style="width: 150px; height: 150px; object-fit: cover; border-radius: 50%;"
                             class="profile-avatar mb-3">
                        <h2 class="mb-3">${data.nombre}</h2>
                        
                        ${data.esPropietario 
                            ? '<a href="/MyPsiqueTFG/perfil/editar" class="btn btn-primary btn-sm w-100 mb-2">Editar Perfil</a>' 
                            : ''}
                        
                        ${data.tipo === 'psicologo' ? `
                            <hr>
                            <p class="mb-2">
                                <strong>Especialidad:</strong><br>
                                ${data.especialidad}
                            </p>
                            <p class="mb-2">
                                <strong>Teléfono:</strong><br>
                                <a href="tel:${data.telefono}" class="text-info">${data.telefono}</a>
                            </p>
                            <p class="mb-0">
                                <strong>Email:</strong><br>
                                <a href="mailto:${data.email}" class="text-info">${data.email}</a>
                            </p>
                            <hr>
                            <p class="mb-0">
                                <strong>Reservar sesión:</strong><br>
                                <button><a href="/MyPsiqueTFG/reserva/${data.nombre}-${user_id}">Reservar</a></button>
                            </p>
                            
                        ` : ''}
                    </div>
                </div>
            </div>
            
            
            <div class="col-md-8">
                <div id="publicaciones-container"></div>
            </div>
        `;
        
        document.getElementById('perfil-container').innerHTML = html;
        
        if (data.tipo === 'psicologo' && data.publicaciones && data.publicaciones.length > 0) {
            let publicacionesHtml = '<h4 class="mb-4 text-white">Publicaciones</h4>';
            data.publicaciones.forEach(pub => {
                publicacionesHtml += `
                    <div class="card text-white mb-4 border-secondary">
                        <div class="card-body">
                            <h5 class="card-title text-dark">${pub.titulo}</h5>
                            <p class="card-text text-dark">${pub.descripcion}</p>
                            ${pub.codigoImagen1 ? `
                                <img src="/MyPsiqueTFG/app/uploads/${pub.codigoImagen1}" 
                                     class="img-fluid rounded mb-3">
                            ` : ''}
                            ${pub.codigoImagen2 ? `
                                <img src="/MyPsiqueTFG/app/uploads/${pub.codigoImagen2}" 
                                     class="img-fluid rounded mb-3">
                            ` : ''}
                            ${pub.codigoImagen3 ? `
                                <img src="/MyPsiqueTFG/app/uploads/${pub.codigoImagen3}" 
                                     class="img-fluid rounded mb-3">
                            ` : ''}
                            <div>
                            <small class="text-muted">
                                ${new Date(pub.fecha_creacion).toLocaleDateString('es-ES')}
                                ❤️${pub.likes} likes
                            </small>
                            </div>
                        </div>
                    </div>
                `;
            });
            document.getElementById('publicaciones-container').innerHTML = publicacionesHtml;
        } else if (data.tipo === 'psicologo') {
            document.getElementById('publicaciones-container').innerHTML = 
                '<p class="text-muted">No hay publicaciones aún</p>';
        }
    })
    .catch(err => {
        document.getElementById('perfil-container').innerHTML = 
            `<div class="col-12"><p class="text-danger"> ${err.message}</p></div>`;
    });
</script>
</body>
</html>