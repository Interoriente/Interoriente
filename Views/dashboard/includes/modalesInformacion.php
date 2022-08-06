<!-- Modal alerta stock -->
<div class="modal fade" id="verAlertaStock" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <b>
                    <h4 class="modal-title" id="myModalLabel">Publicaciones con poco stock</h4>
                </b>
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <!-- Modal Body -->
            <div class="modal-body">
                <p class="statusMsg"></p>
                <!-- Mostrar publicaciones con poco stock -->
                <div class="form-group">
                    <?php foreach ($alertaStock as $datos) {
                    ?>
                        <label id="texto"><b><?= $datos['nombrePublicacion']; ?></b><br> Cantidad: <?= $datos['cantidadPublicacion']; ?><br>Stock mínimo: <?= $datos['stockMinPublicacion']; ?></label><br>
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
                <b>
                    <h4 class="modal-title" id="myModalLabel">Publicaciones no validadas</h4>
                </b>
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <!-- Modal Body -->
            <div class="modal-body">
                <p class="statusMsg"></p>
                <!-- Mostrar las publicaciones sin validar -->
                <div class="form-group">
                    <?php foreach ($noValidadas as $datos) { ?>
                        <label id="texto"><b><?= $datos['nombrePublicacion']; ?></b></label><br>
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