<div class="modal fade" id="modalPublicacion" tabindex="-1" aria-labelledby="modalPublicacionLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="/MyPsiqueTFG/app/controllers/PublicacionController.php" method="POST">
        <div class="modal-header">
          <h5 class="modal-title" id="modalPublicacionLabel">Nueva Publicación</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="id_psicologo" value="<?= $_SESSION['user_id'] ?>">
          <div class="mb-3">
            <label for="titulo" class="form-label">Título</label>
            <input type="text" id="titulo" name="titulo" class="form-control" required placeholder="Ingrese el título de la publicación">
          </div>
          <div class="mb-3">
            <label for="contenido" class="form-label">Contenido</label>
            <textarea id="contenido" name="contenido" class="form-control" required placeholder="Escribe tu publicación aquí..."></textarea>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-success">Publicar</button>
        </div>
      </form>
    </div>
  </div>
</div>