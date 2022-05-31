<div class="modal fade" id="eliminarDirModal<?= $direccion['idDireccion'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form action="../../../Controllers/php/users/usuarios.php" method="post">
      <input type="hidden" name="eliminarDireccion">
      <input type="hidden" name="idDireccion" value="<?= $direccion['idDireccion'] ?>">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">¿Seguro quieres eliminar esta dirección?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Seleccione "Eliminar" para eliminar la dirección, esta acción no se podrá deshacer.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary " type="button" data-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-danger">Eliminar</button>
        </div>
      </div>
    </form>
  </div>
</div>


<!-- Modal para actualizar direcciones -->
<div class="modal fade" id="actualizarDirModal<?= $direccion['idDireccion'] ?>" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">Actualizar Dirección</h4>
        <button type="button" class="close" data-dismiss="modal">
          <span aria-hidden="true">×</span>
        </button>
      </div>

      <!-- Modal Body -->
      <div class="modal-body">
        <p class="statusMsg"></p>
        <form method="POST" action="../../../Controllers/php/users/usuarios.php">
          <!-- Actualiar dirección -->
          <input type="hidden" name="actualizarDireccion">

          <div class="form-group">
            <label for="inputName">Nombre</label>
            <input type="text" class="form-control" id="inputName" name="nombre" placeholder="Nombre" value="<?= $direccion['nombreDireccion'] ?>">
          </div>
          <div class="form-group">
            <label for="inputDireccion">Dirección</label>
            <input type="text" class="form-control" id="inputDireccion" name="direccion" placeholder="Dirección" value="<?= $direccion['descripcionDireccion'] ?>">
          </div>
          <div class="form-group">
            <label for="inputCiudad">Ciudad</label>
            <select name="ciudad" id="ciudad" class="form-control">
              <option value="<?= $direccion['idCiudad'] ?>"><?= $direccion['nombreCiudad'] ?></option>
              <?php foreach ($respGetCiudades as $ciudad) :
              ?>
                <option value="<?= $ciudad['idCiudad'] ?>"><?= $ciudad['nombreCiudad'] ?></option>
              <?php endforeach; ?>
            </select>
            <!-- Capturo id dirección a editar -->
            <input type="hidden" name="idDireccion" value="<?= $direccion['idDireccion']; ?>">
          </div>
          <!-- Modal Footer -->
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-primary submitBtn">Actualizar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>