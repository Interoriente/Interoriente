<!--
=========================================================
* Argon Dashboard - v1.2.0
=========================================================
* Product Page: https://www.creative-tim.com/product/argon-dashboard
* Copyright  Inter-oriente (http://www.creative-tim.com)
* Coded by www.creative-tim.com
=========================================================
* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->

<!-- PHP para inicio de Sesion con Google -->
<?php require "../includes/linksGoogle.php"; ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Bienvenidos a Interoriente, podrás comprar, vender y mucho más.">
    <meta name="author" content="Inter-oriente">
    <title>Recuperar Contraseña | Interoriente</title>
    <!-- Favicon -->
    <link rel="icon" href="../assets/img/favicon.png" type="image/png">
    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
    <!-- Icons -->
    <link rel="stylesheet" href="../dashboard/assets/css/iconos.css" type="text/css">
    <link rel="stylesheet" href="../dashboard/assets/css/iconosComplementos.css" type="text/css">
    <link rel="stylesheet" href="../dashboard/assets/css/all.min.css" type="text/css">
    <link rel="stylesheet" href="../assets/css/general.css">
    <link rel="stylesheet" href="../assets/css/checkout.css" />
    <!-- No eliminar este script -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <!-- Argon CSS -->
    <link rel="stylesheet" href="../dashboard/assets/css/argon.min.css?v=1.2.0" type="text/css">

</head>

<body class="bg-default">

    <div class="navegacion">
        <a href="index.php"> <img id="logo" src="../assets/img/LogoCuaternario.svg" alt="Logo barra de navegación"></a>
    </div>
    <!-- Main content -->
    <div class="main-content">
        <!-- Header -->
        <div class="header bg-gradient-primary py-7 py-lg-5 pt-lg-4">
            <div class="container">
                <div class="header-body text-center mb-7">
                    <div class="row justify-content-center">
                        <div class="col-xl-5 ">
                            <h1 class="text-white" id="h1IniciarSesion">Recupera tu contraseña</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Page content -->
        <div class="container mt--8 pb-5">
            <!-- Table -->
            <div class="row justify-content-center">
                <div class="col-lg-6 col-md-7">
                    <div class="card bg-secondary border-0">

                        <div class="card-body px-lg-3 py-lg-2">

                            <form action="recuperarContra.php" method="POST">
                                <input type="hidden" name="recuperarContraseña">
                                <div class="form-group">
                                    <label for="id">Ingresa tu Email</label>
                                    <div class="input-group input-group-merge input-group-alternative mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                                        </div>
                                        <input class="form-control" id="id" placeholder="tucorreo@gmail.com" type="text" name="email" require>
                                    </div>
                                </div>

                                <div class="text-center">

                                    <button type="submit" class="btn btn-primary mt-4" id="btnIniciarSesion">Recuperar contraseña</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-6 text-left">
                            <a href="iniciarsesion.php" class="text-light"><small>¿Tienes cuenta?</small></a>
                        </div>
                        <div class="col-6 text-right">
                            <a href="registro.php" class="text-light"><small>¿No tienes una cuenta?</small></a>

                        </div>
                        <br>
                        <br>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <script src="../js/iniciarSesion.js"></script>
</body>

</html>