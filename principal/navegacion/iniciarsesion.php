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
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Bienvenidos a Interoriente, podrás comprar, vender y mucho más.">
    <meta name="author" content="Inter-oriente">
    <title>Iniciar sesión - Interoriente</title>
    <!-- Favicon -->
    <link rel="icon" href="../../assets/img/favicon.png" type="image/png">
    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
    <!-- Icons -->
    <link rel="stylesheet" href="../../users/dashboard/assets/vendor/nucleo/css/nucleo.css" type="text/css">
    <link rel="stylesheet" href="../../users/dashboard/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" type="text/css">
    <!-- Argon CSS -->
    <link rel="stylesheet" href="../../users/dashboard/assets/css/argon.css?v=1.2.0" type="text/css">
</head>

<body class="bg-default">
    <!-- Script para llamar ciertos caracteres -->
    <script>
    function Sololetras(e) {

      key = e.keycode || e.which;
      teclado = String.fromCharCode(key).toLowerCase();

      usuario = "abcdefghijklmnñopqrstuvwxyz1234567890@.";

      especiales = "8-37-39-46-164"; //aray

      teclado_especial = false;

      for (var i in especiales) {

        if (key == especiales[i]) {
          teclado_especial = true;
          break;

        }

      }

      if (usuario.indexOf(teclado) == -1 && !teclado_especial) {
        return false;

      }
    }
  </script>
    <!-- Main content -->
    <div class="main-content">
        <!-- Header -->
        <div class="header bg-gradient-primary py-7 py-lg-8 pt-lg-9">
            <div class="container">
                <div class="header-body text-center mb-7">
                    <div class="row justify-content-center">
                        <div class="col-xl-5 col-lg-6 col-md-8 px-5">
                            <h1 class="text-white">Iniciar sesión</h1>
                            <p class="text-lead text-white">Aquí podrás iniciar sesión, Bienvenido.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="separator separator-bottom separator-skew zindex-100">
                <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1" xmlns="http://www.w3.org/2000/svg">
                    <polygon class="fill-default" points="2560 0 2560 100 0 100"></polygon>
                </svg>
            </div>
        </div>
        <!-- Page content -->
        <div class="container mt--8 pb-5">
            <!-- Table -->
            <div class="row justify-content-center">
                <div class="col-lg-5 col-md-7">
                    <div class="card bg-secondary border-0">
                        <div class="card-header bg-transparent pb-5">
                            <div class="text-muted text-center mt-2 mb-4"><small>Puedes iniciar sesión por:</small></div>
                            <div class="text-center">
                                <a href="productos.php" class="btn btn-neutral btn-icon mr-4">
                                    <span class="btn-inner--icon"><img src="../../users/dashboard/assets/img/icons/common/github.svg"></span>
                                    <span class="btn-inner--text">Productos</span>
                                </a>
                                <a href="../publicacion/index.php" class="btn btn-neutral btn-icon">
                                    <span class="btn-inner--icon"><img src="../../users/dashboard/assets/img/icons/common/google.svg"></span>
                                    <span class="btn-inner--text">Comprar</span>
                                </a>
                            </div>
                        </div>
                        <div class="card-body px-lg-5 py-lg-5">
                            <div class="text-center text-muted mb-4">
                                <small>O con tus datos puedes diligenciar tus datos en los siguientes campos</small>
                            </div>
                            <form action="../../php/crud/iniciarSesion.php" method="POST">
                                <div class="form-group">
                                    <label for="">Correo o documento:</label>
                                    <div class="input-group input-group-merge input-group-alternative mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                                        </div>
                                        <input class="form-control" placeholder="example@gmail.com" type="text" name="id" onkeypress="return Sololetras(event)" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="">Contraseña:</label>
                                    <div class="input-group input-group-merge input-group-alternative mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="ni ni-key-25"></i></span>
                                        </div>
                                        <input class="form-control" placeholder="**********" type="password" name="contrasena" maxlength="20" required>
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
                            <a href="recuContrasena.php" class="text-light"><small>Olvidó contraseña?</small></a>
                        </div>
                        <div class="col-6 text-right">
                            <a href="registro.php" class="text-light"><small>No tienes cuenta?</small></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Core -->
    <script src="../../users/dashboard/assets/vendor/jquery/dist/jquery.min.js"></script>
    <script src="../../users/dashboard/assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../../users/dashboard/assets/vendor/js-cookie/js.cookie.js"></script>
    <script src="../../users/dashboard/assets/vendor/jquery.scrollbar/jquery.scrollbar.min.js"></script>
    <script src="../../users/dashboard/assets/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js"></script>
    <!-- Argon JS -->
    <script src="../../users/dashboard/assets/js/argon.js?v=1.2.0"></script>


</html>