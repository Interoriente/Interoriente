<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Favicon -->
    <link rel="icon" href="../assets/img/favicon.png" type="image/png">
    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
    <!-- Icons -->
    <link rel="stylesheet" href="../dashboard/assets/css/iconos.css" type="text/css">
    <link rel="stylesheet" href="../dashboard/assets/css/iconosComplementos.css" type="text/css">
    <link rel="stylesheet" href="../dashboard/assets/css/all.min.css" type="text/css">
    <!-- Argon CSS -->
    <link rel="stylesheet" href="../dashboard/assets/css/argon.min.css?v=1.2.0" type="text/css">
    <title>Registrarse | Interoriente</title>
</head>

<body class="bg-default">
    <!-- Main content -->
    <div class="main-content">
        <!-- Header -->
        <div class="header bg-gradient-primary py-7 py-lg-5 pt-lg-4">
            <div class="container">
                <div class="header-body text-center mb-7">
                    <div class="row justify-content-center">
                        <div class="col-xl-5 col-lg-6 col-md-8 px-5">
                            <h1 class="text-white">Continua con estos datos</h1>
                            <p class="text-lead text-white">Aquí podrás crear una cuenta con tus datos personales.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Page content -->
        <div class="container mt--8 pb-5">
            <!-- Table -->
            <div class="row justify-content-center">
                <div class="col-lg-6 col-md-8">
                    <div class="card bg-secondary border-0">
                        <div class="card-body px-lg-5 py-lg-5">
                            <form action="../../Controllers/php/users/acceso.php" method="POST">
                                <input type="hidden" name="registrarse">
                                <input type="hidden" name="imagen" value="<?= $_SESSION['picture']; ?>">
                                <input type="hidden" name="correo" required value="<?= $_SESSION['email']; ?>">
                                <input class="form-control" placeholder="Nombres" type="hidden" name="nombres" value="<?= $_SESSION['name']; ?>">
                                <input class="form-control" placeholder="Apellidos" type="hidden" name="apellidos" required value="<?= $_SESSION['familyName']; ?>">
                                <div class="form-group">
                                    <label for="">Documento:</label>
                                    <div class="input-group input-group-merge input-group-alternative mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="ni ni-badge"></i></span>
                                        </div>
                                        <input class="form-control" placeholder="Documento" type="number" max="9999999999" name="documento" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="">Contraseña:</label>
                                    <div class="input-group input-group-merge input-group-alternative mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="ni ni-key-25"></i></span>
                                        </div>
                                        <input class="form-control" placeholder="*********" type="password" name="contrasena" minlength="5" maxlength="20" required>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary mt-4">Crear cuenta</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-6">
                            <a href="index.php" class="text-light"><small>Regresar a inicio</small></a>
                        </div>
                        <div class="col-6 text-right">
                            <a href="iniciarsesion" class="text-light"><small>Tienes cuenta?</small></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Core -->
    <script src="../dashboard/assets/js/argon.min.js?v=1.2.0"></script>
</body>

</html>