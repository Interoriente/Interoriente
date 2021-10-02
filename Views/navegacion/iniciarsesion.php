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
<?php
require "../includes/linksGoogle.php";
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Bienvenidos a Interoriente, podrás comprar, vender y mucho más.">
    <meta name="author" content="Interoriente">
    <title>Iniciar sesión | Interoriente</title>
    
    <!-- Favicon -->
    <link rel="icon" href="../assets/img/favicon.png" type="image/png">
    <!-- Fonts ACTUALIZAR-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
    <!-- Icons ACTUALIZAR-->
    <link rel="stylesheet" href="../dashboard/assets/css/iconos.css" type="text/css">
    <link rel="stylesheet" href="../dashboard/assets/css/iconosComplementos.css" type="text/css">
<!--     <link rel="stylesheet" href="../dashboard/assets/css/all.min.css" type="text/css">
 -->    <!-- Argon CSS -->
    <link rel="stylesheet" href="../dashboard/assets/css/argon.min.css?v=1.2.0" type="text/css">
    
</head>

<body class="bg-default" oncontextmenu="return false">
    
    <!-- Main content -->
    <div class="main-content">
        <!-- Header -->
        <div class="header bg-gradient-primary py-7 py-lg-8 pt-lg-9">
            <div class="container">
                <div class="header-body text-center mb-7">
                    <div class="row justify-content-center">
                        <div class="col-xl-5 col-lg-6 col-md-1 px-5">
                            <h1 class="text-white">Iniciar sesión</h1>
                            <p class="text-lead text-white">Aquí podrás iniciar sesión, Bienvenido.</p>
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
                        <div class="card-header bg-transparent pb-5">
                            <div class="text-muted text-center mt-2 mb-4"><small>Puedes iniciar sesión por:</small></div>
                            <div class="text-center">
                                <a href="<?php echo $GoogleLogin; ?>" class="btn btn-neutral btn-icon">
                                    <span class="btn-inner--icon"><img src="../dashboard/assets/img/google.svg"></span>
                                    <span class="btn-inner--text">Google</span>
                                </a>
                            </div>
                        </div>
                        <div class="card-body px-lg-5 py-lg-5">
                            <div class="text-center text-muted mb-4">
                                <small>O con tus credenciales de acceso:</small>
                            </div>
                            <form action="../../Controllers/php/users/acceso.php" method="POST">
                                <input type="hidden" name="iniciarSesion">
                                <div class="form-group">
                                    <label for="id">Email o documento de identidad:</label>
                                    <div class="input-group input-group-merge input-group-alternative mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                                        </div>
                                        <input class="form-control" id="id" placeholder="tucorreo@gmail.com" type="text" name="id" onkeypress="return Sololetras(event)" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="contrasena">Contraseña:</label>
                                    <div class="input-group input-group-merge input-group-alternative mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="ni ni-key-25"></i></span>
                                        </div>
                                        <input class="form-control" id="contrasena" placeholder="**********" type="password" name="contrasena" minlength="2" maxlength="20" required>
                                    </div>
                                </div>
                                <div class="text-center">

                                    <button type="submit" class="btn btn-primary mt-4">Iniciar sesión</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-6">
                            <a href="recuContrasena.php" class="text-light"><small>¿Olvidaste tu contraseña?</small></a>
                        </div>
                        <div class="col-6 text-right">
                            <a href="registro.php" class="text-light"><small>O si no tienes cuenta, regístrate por acá</small></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Argon JS -->
   <!-- Qué función está cumpliendo este script? --> 
<!--     <script src="../dashboard/assets/js/argon.min.js?v=1.2.0"></script>
 -->
</html>