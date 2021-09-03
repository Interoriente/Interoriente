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
?>
        <!DOCTYPE html>
        <html>

        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
            <meta name="description" content="Bienvenidos a Interoriente, podrás comprar, vender y mucho más.">
            <meta name="author" content="Inter-oriente">
            <title>Soporte - Interoriente</title>
            <!-- Favicon -->
            <link rel="icon" href="../../assets/img/favicon.png" type="image/png">
            <!-- Fonts -->
            <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
            <!-- Icons -->
            <link rel="stylesheet" href="../assets/vendor/nucleo/css/nucleo.css" type="text/css">
            <link rel="stylesheet" href="../assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" type="text/css">
            <!-- Argon CSS -->
            <link rel="stylesheet" href="../assets/css/argon.min.css?v=1.2.0" type="text/css">
        </head>

        <body>
            <?php
            require_once '../assets/sidebarDashboard.php';
            require_once '../assets/header.php'; ?>

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
                <!-- Footer -->
                <?php require_once '../assets/footer.php' ?>
            </div>
        </body>

        </html>
<?php
    } else {
        echo "<script>alert('No puedes acceder a esta página!');</script>";
        echo "<script> document.location.href='403.php';</script>";
    }
} else {
    echo "<script>alert('No has iniciado sesión');</script>";
    echo "<script> document.location.href='403.php';</script>";
}

?>