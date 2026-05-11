<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mensajes | MyPsique</title>
    <link rel="stylesheet" href="/MyPsiqueTFG/public/styles/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="/MyPsiqueTFG/public/styles/custom/styles.css">
    
</head>
<body>
    <?php include '../layouts/header.php';  ?>

    <div class="container pt-5">
        <div class="row border ">
            <div class="col-2 border text-break" id="panelConversaciones">
                ESTE ES EL PANEL DE CONVERSACIONES
            </div>
            <div class="col-10 border text-break" id="conversacion">
                ESTA ES LA VENTANA PRINCIPAL DE ONVERSACION
            </div>
        </div>
    </div>

    <?php include '../layouts/footer.php';  ?>
    <script>
        
        let panelConv = document.getElementById('panelConversaciones');
        let ventanaConv = document.getElementById('conversacion');

        function cargarConversaciones( usuario = <?php echo $_SESSION['user_id'];?>){
            console.log('Cargando conversaciones para el usuario:', usuario);
            fetch(`/MyPsiqueTFG/app/controllers/MensajeController.php?Accion=getConversations`)
                .then(res => {
                    if (!res.ok) throw new Error('Error al cargar conversaciones');
                    console.log('Respuesta del servidor:', res);
                    return res.json();
                })
                .then(data => {
                    data.forEach(conv => {
                        newDiv = document.createElement('div');
                        newDiv.innerHTML = conv.id;
                        panelConv.appendChild(newDiv);
                    });
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }

        function cargarMensajes(){

        }

        cargarConversaciones();
    </script>
</body>
</html>