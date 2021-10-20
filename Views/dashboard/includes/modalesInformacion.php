<!-- Modal alerta stock -->
<div class="modal fade" id="verAlertaStock" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Publicaciones con stock minimo</h4>
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <!-- Modal Body -->
            <div class="modal-body">
                <p class="statusMsg"></p>
                <!-- Actualiar dirección -->
                <input type="hidden" name="actualizarPublicacion">

                <div class="form-group">
                    <?php foreach ($mostrarPublicacionPocoStock as $datos) {
                    ?>
                        <label id="texto">*<?php echo $datos['nombrePublicacion']; ?><br> Cantidad: <?php echo $datos['cantidadPublicacion']; ?><br>Stock: <?php echo $datos['stockMinPublicacion']; ?></label><br>
                    <?php } ?>
                </div>
                <!-- Modal Footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal no validadas -->
<div class="modal fade" id="verNovalidadas" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Publicaciones no validadas</h4>
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <!-- Modal Body -->
            <div class="modal-body">
                <p class="statusMsg"></p>

                <div class="form-group">
                    <?php foreach ($mostrarNoValidadas as $datos) {
                    ?>
                        <label id="texto">*<?php echo $datos['nombrePublicacion']; ?></label><br>
                    <?php } ?>
                </div>
                <!-- Modal Footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
</div>