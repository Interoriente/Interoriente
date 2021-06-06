<?php
include_once '../../dao/conexion.php';
$nombre = $_POST['buscar'];

//Sentencia para buscar
$sql_buscar = "SELECT * FROM tblusuario WHERE correo=?";
$consulta_buscar = $pdo->prepare($sql_buscar);
$consulta_buscar->execute(array($nombre));
$resultado_buscar = $consulta_buscar->fetchAll();
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <title>Buscando...</title>
</head>

<body>
    <br><br>
    <!---Tabla de restaurantes -->
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr align="center" Style="border: 2px solid black">
                    <th Style="border: 2px solid black">Nombre</th>
                    <th Style="border: 2px solid black">Dirección</th>
                    <th Style="border: 2px solid black">Telefono</th>
                    <th Style="border: 2px solid black">Ciudad</th>
                    <th Style="border: 2px solid black">Nit</th>
                    <th Style="border: 2px solid black">Eliminar</th>
                    <th Style="border: 2px solid black">Editar</th>

                <tr>


            </thead>

            <tbody>
                <?php foreach ($resultado_buscar as $datos) { ?>

                    <tr align="center" Style="border: 2px solid black">
                        <td style="border: 2px solid black"><?php echo $datos['nombre_resta'] ?></td>
                        <td style="border: 2px solid black"><?php echo $datos['direccion_resta'] ?></td>
                        <td style="border: 2px solid black"><?php echo $datos['telefono_resta'] ?></td>
                        <td style="border: 2px solid black"><?php echo $datos['ciudad_resta'] ?></td>
                        <td style="border: 2px solid black"><?php echo $datos['nit_resta'] ?></td>
                        <td style="border: 2px solid black"><a href="delete.php?id=<?php echo $datos['idrestaurante']; ?>">
                                <button class="btn btn-primary btn-xs" type="submit">Eliminar</button></a></td>
                        <td style="border: 2px solid black"><a href="index.php?id=<?php echo $datos['idrestaurante']; ?>">
                                <button class="btn btn-primary btn-xs" type="submit">Editar</button></a></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    </div>

</body>

</html>