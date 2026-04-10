<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contacto</title>
    <link rel="stylesheet" href="../../../public/styles/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../../../public/styles/custom/css/styles.css">
</head>
<body>
    <?php include_once __DIR__ . "/../layouts/header.php"; ?>
    <div class="container mt-5 my-4">
        <h1>Contacto</h1>
        <p>Si tienes alguna pregunta o necesitas más información, no dudes en contactarnos.</p>
        <form action="">
            <div class="mb-3">
                <label for="name" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="name" placeholder="Tu nombre">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Correo electrónico</label>
                <input type="email" class="form-control" id="email" placeholder="Tu correo electrónico">
            </div>
            <div>
                <label for="subject" class="form-label">Asunto</label>
                <input type="text" class="form-control" id="subject" placeholder="Asunto del mensaje">
            </div>
            <div class="mb-3">
                <label for="message" class="form-label">Mensaje</label>
                <textarea class="form-control" id="message" rows="5" placeholder="Escribe tu mensaje aquí"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Enviar</button>
        </form>
    </div>
    <?php include_once __DIR__ . "/../layouts/footer.php"; ?>
</body>
</html>