<div class="modal fade" id="eliminarDirModal<?php echo $direccion['idDireccion'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form action="../../../Controller/php/view/usuarios.php" method="post">
      <input type="hidden" name="eliminarDireccion">
      <input type="hidden" name="idDireccion" value="<?php echo $direccion['idDireccion'] ?>">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">¿Seguro quieres eliminar esta dirección?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Seleccione "Eliminar" para eliminar la dirección, esta acción no se podrá deshacer.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-danger">Eliminar</button>
        </div>
      </div>
    </form>
  </div>
</div>


<!-- Modal para actualizar direcciones -->
<div class="modal fade" id="actualizarDirModal<?php echo $direccion['idDireccion'] ?>" role="dialog">
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
        <form method="POST" action="../../../Controller/php/view/usuarios.php">
          <!-- Actualiar dirección -->
          <input type="hidden" name="actualizarDireccion">

          <div class="form-group">
            <label for="inputName">Nombre</label>
            <input type="text" class="form-control" id="inputName" name="nombre" placeholder="Nombre" value="<?php echo $direccion['nombreDireccion'] ?>">
          </div>
          <div class="form-group">
            <label for="inputDireccion">Dirección</label>
            <input type="text" class="form-control" id="inputDireccion" name="direccion" placeholder="Dirección" value="<?php echo $direccion['descripcionDireccion'] ?>">
          </div>
          <div class="form-group">
            <label for="inputCiudad">Ciudad</label>
            <select name="ciudad" id="ciudad" class="form-control">
              <option value="<?php echo $direccion['idCiudad'] ?>"><?php echo $direccion['nombreCiudad'] ?></option>
              <?php foreach ($respGetCiudades as $ciudad) {
              ?>
                <option value="<?php echo $ciudad['idCiudad'] ?>"><?php echo $ciudad['nombreCiudad'] ?></option>
              <?php } ?>
            </select>
            <!-- Capturo id dirección a editar -->
            <input type="hidden" name="idDireccion" value="<?php echo $direccion['idDireccion']; ?>">
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