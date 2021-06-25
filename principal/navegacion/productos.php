<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- CSS only -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
  <!-- JavaScript Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
  <title>Productos</title>
</head>

<body>
  <?php
  require '../../dao/conexion.php';
  //Mostrar los datos almacenados
  $sql_mostrar = "SELECT * FROM tblPublicacion";
  //Prepara sentencia
  $consultar_mostrar = $pdo->prepare($sql_mostrar);
  //Ejecutar consulta
  $consultar_mostrar->execute();

  //Mostrar los datos almacenados tabla imagenes
  $sql_mostrar1 = "SELECT * FROM tblImagenes";
  //Prepara sentencia
  $consultar_mostrar1 = $pdo->prepare($sql_mostrar1);
  //Ejecutar consulta
  $consultar_mostrar1->execute();
  //Imprimir var dump -> Arreglos u objetos
  ?>
  <header class="bg-primary text-center py-5 mb-4">
    <div class="container">
      <h1 class="tituloplaz">Productos</h1>
    </div>
  </header>
  <div class="container">
    <div class="row">
      <?php while ($resultado_mostrar = $consultar_mostrar->fetch(PDO::FETCH_OBJ) AND $resultado_mostrar1 = $consultar_mostrar1->fetch(PDO::FETCH_OBJ)) {
      ?>
        <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
          <div class="card h-100">
            <div class="card-body">
              <img class="card-img-top rounded" src="../../users/dashboard/principal/imagenes/<?php echo $resultado_mostrar1->urlImagen; ?>" alt="...">
              <h4 class="card-title">
                <p><?php echo $resultado_mostrar->nombrePublicacion ?></p>
              </h4>
              <p><?php echo $resultado_mostrar->descripcionPublicacion ?></p>
              <p>Stock: <?php echo $resultado_mostrar->stockProducto ?></p>
              <p>$<?php echo $resultado_mostrar->costoPublicacion ?></p>
            </div>
          </div>
        </div>
      <?php
      }
      ?>
</body>

</html>