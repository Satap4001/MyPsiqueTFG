<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Perfil</title>
    <link rel="stylesheet" href="../../../public/styles/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../../../public/styles/custom/css/styles.css">
</head>
<body>
    <?php include '../layouts/header.php'; ?>

    <div class="container mt-5" id="perfil-container">
        
        <p class="text-muted">Cargando perfil...</p>
    </div>

    <script>
    
    const params = new URLSearchParams(window.location.search);
    const user_id = params.get('user_id');

    fetch(`/MyPsiqueTFG/app/controllers/PerfilController.php?user_id=${user_id}`)
    .then(res => {
        if (!res.ok) throw new Error('Usuario no encontrado');
        return res.json();
    })
    .then(data => {
        document.getElementById('perfil-container').innerHTML = `
            <div class="profile-header">
                <div class="row align-items-center">
                    <div class="col-md-3 text-center">
                        <img src="/MyPsiqueTFG/app/uploads/avatar/${data.avatar || 'default.png'}" 
                             alt="${data.nombre}" style="width: 150px; height: 150px; object-fit: cover; border-radius: 50%;"
                             class="profile-avatar">
                    </div>
                    <div class="col-md-9">
                        <h1 class="mb-2 text-white">${data.nombre}</h1>
                        ${data.esPropietario 
                            ? '<a href="modPerfil.php" class="btn btn-primary btn-sm">Editar Perfil</a>' 
                            : ''}
                        ${data.tipo === 'psicologo' 
                            ? `<p><strong>Especialidad:</strong> ${data.especialidad}</p>
                               <p><strong>Teléfono:</strong> <a href="tel:${data.telefono}">${data.telefono}</a></p>
                               <p><strong>Gmail:</strong> <a href="mailto:${data.email}">${data.email}</a></p>
                               <div id="publicaciones-container"></div>` 
                            : ''}
                    </div>
                </div>
            </div>
        `;
        
        // Cargar publicaciones si es psicólogo
        if (data.tipo === 'psicologo' && data.publicaciones) {
            let publicacionesHtml = '<h5>Publicaciones</h5>';
            data.publicaciones.forEach(pub => {
                publicacionesHtml += `
                    <div class="card mb-3">
                        <div class="card-body">
                            <h6>${pub.titulo}</h6>
                            <p>${pub.descripcion}</p>
                            ${pub.codigoImagen1 ? `<img src="/MyPsiqueTFG/app/uploads/${pub.codigoImagen1}" class="img-fluid">` : ''}
                        </div>
                    </div>
                `;
            });
            document.getElementById('publicaciones-container').innerHTML = publicacionesHtml;
        }
    })
    .catch(err => {
        document.getElementById('perfil-container').innerHTML = 
            `<p class="text-danger">${err.message}</p>`;
    });
    </script>
</body>
</html>