<?php
// Iniciar variables de sesion, obtener DocId y Rol ACTUAL del usuario
session_start();
$respUserData = null;
if (isset($_SESSION['documentoIdentidad'])) {
    $documento = $_SESSION["documentoIdentidad"];
    $rol = $_SESSION['roles'];
    // Pedir clases Usuarios y Publicaciones (Iniciarlas en variables PHP)
    require "../../../Controllers/php/users/usuarios.php";
    $usuario = new Usuario($documento);
    $respUserData = $usuario->getUserData($usuario->id);
}
if (isset($respUserData)) {
    if ($rol == 1 or $rol == 3) {

        //Parte superior del HTML
        require "../includes/header.php";

        require_once '../includes/sidebarDashboard.php';
        require_once '../includes/navegacion.php'; ?>

        <br><br><br><br>
        <!-- Formulario de soporte -->
        <div class="container-fluid mt--6">
            <div class="row">
                <div class="col-xl-8 order-xl-1">
                    <div class="card">
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col-8">
                                    <h3 class="mb-0">Soporte</h3>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="../../../Controllers/email/mailSoporte.php" method="POST" enctype="multipart/form-data">
                                <h6 class="heading-small text-muted mb-4">Aquí podrás realizar las preguntas, quejas, reclamos o sugerencias del funcionamiento de la aplicación</h6>
                                <div class="pl-lg-4">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">Nombre:</label>
                                                <input type="text" id="input-username" name="nombre" class="form-control" placeholder="Nombre" value="" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">Correo:</label>
                                                <input type="email" id="input-username" name="correo" class="form-control" placeholder="Correo" maxlength="5000" value="" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">Teléfono:</label>
                                                <input type="number" id="input-username" name="telefono" class="form-control" placeholder="Teléfono" value="" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">Tipo de mensaje:</label>
                                                <select name="tipo" id="">
                                                    <option value="" selected disabled>Selecciona un tipo de mensaje</option>
                                                    <option value="Pregunta">Pregunta</option>
                                                    <option value="Sugerencia">Sugerencia</option>
                                                    <option value="Petición">Petición</option>
                                                    <option value="Queja">Queja</option>
                                                    <option value="Reclamo">Reclamo</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">Mensaje</label>
                                                <textarea name="mensaje" id="input-username" class="form-control" cols="34" rows="6" required></textarea>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">Pantallazo (Opcional)</label>
                                                <input type="file" name="archivo" id="input-username" class="form-control-file">
                                            </div>
                                        </div>
                                    </div>
                                    <button class="btn btn-primary btn-xs" type="submit" name="subir">Enviar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer -->
<?php require_once '../includes/footer.php';
    } else {
        echo "<script>alert('No puedes acceder a esta página!');</script>";
        echo "<script> document.location.href='403.php';</script>";
    }
} else {
    echo "<script>alert('No has iniciado sesión');</script>";
    echo "<script> document.location.href='403.php';</script>";
}

?>