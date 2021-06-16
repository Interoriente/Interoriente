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
    include_once 'dao/conexion.php';
    //Mostrar los datos almacenados
    $sql_mostrar = "SELECT * FROM tblPublicacion";
    //Prepara sentencia
    $consultar_mostrar = $pdo->prepare($sql_mostrar);
    //Ejecutar consulta
    $consultar_mostrar->execute();
    $resultado_mostrar = $consultar_mostrar->fetchAll();
    //Imprimir var dump -> Arreglos u objetos
    ?>
    <header class="bg-primary text-center py-5 mb-4">
      <div class="container">
        <h1 class="tituloplaz">Productos</h1>
      </div>
    </header>
    <div class="container">
          <div class="row">
            <?php foreach ($resultado_mostrar as $datos) {
            ?>
                <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                  <div class="card h-100">
                    <div class="card-body">
                      <!--<img class="card-img-top rounded" src="users/dashboard/principal/// echo $datos['imagen']; ?>" alt="...">-->
                      <h4 class="card-title">
                        <p><?php echo $datos['nombrePublicacion'] ?></p>
                      </h4>
                      <p><?php echo $datos['descripcionPublicacion'] ?></p>
                      <p>Stock: <?php echo $datos['stockProducto'] ?></p>
                      <p>$<?php echo $datos['costoPublicacion'] ?></p>
                    </div>
                  </div>
                </div>
            <?php
              }
            ?>
</body>

</html>