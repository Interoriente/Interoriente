<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="assets/bootstrap/css/estilos.css">
  <link rel="icon" href="../../assets/img/favicon.png" type="image/png" />
  <title>Document</title>
</head>

<body>
  <!-- Barra de navegación -->
  <?php
  include '../includes/superior.php';
  ?>
  <!-- ----- -->



  <div class="star-wrapper">
    <a href="#" class="fas fa-star s1"></a>
    <a href="#" class="fas fa-star s2"></a>
    <a href="#" class="fas fa-star s3"></a>
    <a href="#" class="fas fa-star s4"></a>
    <a href="#" class="fas fa-star s5"></a>
  </div>
  <!-- Sidebar -->
  <?php include '../includes/navInferior.php'; ?>
  <!-- ------- -->

  <!-- Barra de navegación para dispositivos móviles -->
  <?php
  include '../includes/navMovil.php';
  ?>
</body>

</html>