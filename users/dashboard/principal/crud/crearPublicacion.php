<?php
          if (isset($_POST['subir'])) {
            include_once '../../../../dao/conexion.php';
            $nombre = $_POST['nombre'];
            $descripcion = $_POST['descripcion'];
            $color = $_POST['color'];
            $costo = $_POST['costo'];
            $estadoarticulo = $_POST['estado'];
            $estadopublicacion = '3';
            $stock = $_POST['stock'];
            $categoria = $_POST['categoria'];
            $usuario = $_POST['usuario'];
            //sentencia Sql
            $sql_insertar = "INSERT INTO tblPublicacion (nombrePublicacion,usuario,descripcionPublicacion,colorPublicacion,costoPublicacion,estadoArticulo,estadoPublicacion,stockProducto,categoria )VALUES (?,?,?,?,?,?,?,?,?)";
            //Preparar consulta
            $consulta_insertar = $pdo->prepare($sql_insertar);
            //Ejecutar la sentencia
            $consulta_insertar->execute(array($nombre, $usuario, $descripcion, $color, $costo, $estadoarticulo, $estadopublicacion, $stock, $categoria));
            echo "<script>alert('El registro se subió correctamente');</script>";
            echo "<script> document.location.href='../crearPubli.php';</script>";
          }
