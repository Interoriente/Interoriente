<?php
if (isset($_POST['crearPublicacion'])) {
    /* Capturar datos */
    $nombre = htmlentities($_POST['nombre']);
    $descripcion = htmlentities($_POST['descripcion']);
    $costo = htmlentities($_POST['costo']);
    $cantidad = htmlentities($_POST['cantidad']);
    $stockMin = htmlentities($_POST['stockMin']);
    $categoria = htmlentities($_POST['categoria']);
    $documentoIdentidad = htmlentities($_POST['usuario']);
    /* Instanciar clase */
    $publicaciones = new Publicaciones($documentoIdentidad);
    /* Llamar función */
    $publicaciones->CrearPublicacion(
        $nombre,
        $descripcion,
        $costo,
        $cantidad,
        $stockMin,
        $categoria,
        $documentoIdentidad
    );
} else if (isset($_POST['activarPublicacion'])) {
    $id = htmlentities($_POST['id']);
    $publicacion = new Publicaciones($id);
    $publicacion->ActivarPublicacion($publicacion->id);
} else if (isset($_POST['desactivarPublicacion'])) {
    $id = htmlentities($_POST['id']);
    $publicacion = new Publicaciones($id);
    $publicacion->DesactivarPublicacion($publicacion->id);
} else if (isset($_POST['actualizarPublicacion'])) {
    $id = htmlentities($_POST['idPublicacion']);
    $publicacion = new Publicaciones($id);
    $publicacion->ActualizarPublicacion($publicacion->id);
} else if (isset($_POST['eliminarPublicacion'])) {
    $id = htmlentities($_POST['idPublicacion']);
    $publicacion = new Publicaciones($id);
    $publicacion->EliminarPublicacion($publicacion->id);
}
//Nombre de la clase
class Publicaciones
{
    //Atributos
    public int $id;
    //Metodo constructor
    public function __construct($id)
    {
        $this->id = $id;
    }

    public function MostrarPublicaciones($id)
    {
        require '../../../Models/dao/conexion.php';
        $sqlPubli = "CALL sp_mostrarPublicacionesDashboard(:id)";
        //Prepara sentencia
        $consultarPubli = $pdo->prepare($sqlPubli);
        $consultarPubli->bindValue(":id", $id);
        //Ejecutar consulta
        $consultarPubli->execute();
        return $consultarPubli->fetchAll();
    }

    public function getEstados()
    {
        require '../../../Models/dao/conexion.php';
        /* Lista desplegable de los estados de artículos */
        $sqlEstado = "CALL sp_mostrarEstados()";
        //Prepara sentencia
        $consultarEstado = $pdo->prepare($sqlEstado);
        //Ejecutar consulta
        $consultarEstado->execute();
        $resultadoEstado = $consultarEstado->fetchAll();
        return $resultadoEstado;
    }


    public function getCategorias()
    {
        require '../../../Models/dao/conexion.php';
        /* Lista desplegable de categoría */
        $sqlCategoria = "CALL sp_mostrarCategorias()";
        //Prepara sentencia
        $consultarCategoria = $pdo->prepare($sqlCategoria);
        //Ejecutar consulta
        $consultarCategoria->execute();
        $resultadoCategoria = $consultarCategoria->fetchAll();
        return $resultadoCategoria;
    }


    public function CrearPublicacion(
        $nombrePubli,
        $descripcionPubli,
        $costoPubli,
        $cantidadPubli,
        $stockMinPubli,
        $categoriaPubli,
        $documentoIdentidadPubli
    ) {

        require '../../../Models/dao/conexion.php';
        $verificacion = '0';
        //sentencia SQL
        $sql = "CALL sp_publicacionCrear(:nombre,:descripcion,
            :costo,:cantidad,:stockMin,:categoria,:documento,:verificacion)";
        //Preparar consulta
        $insertarPublicacion = $pdo->prepare($sql);
        $insertarPublicacion->bindValue(":nombre", $nombrePubli);
        $insertarPublicacion->bindValue(":descripcion", $descripcionPubli);
        $insertarPublicacion->bindValue(":costo", $costoPubli);
        $insertarPublicacion->bindValue(":cantidad", $cantidadPubli);
        $insertarPublicacion->bindValue(":stockMin", $stockMinPubli);
        $insertarPublicacion->bindValue(":categoria", $categoriaPubli);
        $insertarPublicacion->bindValue(":documento", $documentoIdentidadPubli);
        $insertarPublicacion->bindValue(":verificacion", $verificacion);
        //Almaceno información
        $insertarPublicacion->execute();
        $insertarPublicacion->closeCursor();

        //Seleccionar último id en la BD
        $sqlUltimoId = "CALL sp_ultimoIdPublicacion";
        $ultimoId = $pdo->prepare($sqlUltimoId);
        $ultimoId->execute();
        $ultimoId = $ultimoId->fetch(PDO::FETCH_ASSOC);
        $idPublicacion = $ultimoId['MAX(idPublicacion)'];

        $idPubli = "id" . $idPublicacion . "_";

        $cantidad = count($_FILES['imagen']['tmp_name']);
        //Ejecutar la sentencia
        for ($i = 0; $i < $cantidad; $i++) {
            //Comprobamos si el fichero es una imagen
            if ($_FILES['imagen']['type'][$i] == 'image/png' || $_FILES['imagen']['type'][$i] == 'image/jpeg' || $_FILES['imagen']['type'][$i] == 'image/jpg') {
                //Le defino una ruta a la imagen
                $directorio = "../../../Views/assets/img/publicaciones/$idPubli";
                //Nombre de la imagen
                $filename = $_FILES['imagen']['name'][$i];
                //Nombre temporal de la imagen -> Por defecto se necesita este paso.
                $temporal = $_FILES['imagen']['tmp_name'][$i];
                $ruta = $directorio . "" . basename($filename);
                //Especifico el nombre que se va a guardar en la BD
                $archivo = "../assets/img/publicaciones/$idPubli" . $filename;
                //Subimos la imagen al servidor
                if (move_uploaded_file($temporal, $ruta)) {
                    //Insertando imagen en la tabla
                    $sqlInsertarImagen = "CALL sp_imagenInsertar(:url,:publicacion)";
                    $insertarImagen = $pdo->prepare($sqlInsertarImagen);
                    $insertarImagen->bindValue(":url", $archivo);
                    $insertarImagen->bindValue(":publicacion", $idPublicacion);
                    $insertarImagen->execute();

                    /* Validar ejecución exitosa de la sentencia */
                    echo "<script>alert('El registro se subió correctamente: Ten en cuenta que debes esperar que se valide esta publicación');</script>";
                    /* Redirigir después de almacenar la información */
                    echo "<script> document.location.href='../../../Views/dashboard/principal/crearPublicacion.php';</script>";
                    //sleep(5);
                } else {
                    echo "<script>alert('Error con el servidor!');</script>";
                    echo "<script> document.location.href='../../../Views/dashboard/principal/crearPublicacion.php';</script>";
                }
            } else {
                echo "<script>alert('Error: formato de imagen no válido');</script>";
                echo "<script> document.location.href='../../../Views/dashboard/principal/crearPublicacion.php';</script>";
            }
        }
    }
    public function MostrarTodasPublicaciones()
    {
        require "../../../Models/dao/conexion.php";
        $sqlMostrarPubli = "CALL sp_mostrarTodasPublicaciones()";
        //Prepara sentencia
        $consultarMostrarPubli = $pdo->prepare($sqlMostrarPubli);
        //Ejecutar consultas
        $consultarMostrarPubli->execute();
        return $consultarMostrarPubli->fetchAll();
    }
    public function ActivarPublicacion($id)
    {
        //Llamada a la conexion
        require '../../../Models/dao/conexion.php';
        $estado = '1';
        //sentencia sql para actualizar estado
        $sqlActivar = "CALL sp_activarPublicacion(:id,:estado)";
        $activar = $pdo->prepare($sqlActivar);
        $activar->bindValue(":estado", $estado);
        $activar->bindValue(":id", $id);
        $activar->execute();

        echo "<script>alert('Estado actualizado correctamente');</script>";
        echo "<script> document.location.href='../../../Views/dashboard/principal/publicaciones';</script>";
    }

    public function DesactivarPublicacion($id)
    {

        //Llamada a la conexion
        require '../../../Models/dao/conexion.php';
        $estado = '0';
        //sentencia sql para actualizar estado
        $sqlDesactivar = "CALL sp_desactivarPublicacion(:id,:estado)";
        $desactivar = $pdo->prepare($sqlDesactivar);
        $desactivar->bindValue(":estado", $estado);
        $desactivar->bindValue(":id", $id);
        $desactivar->execute();
        //alert
        echo "<script>alert('Estado actualizado correctamente');</script>";
        //redireccionar
        echo "<script> document.location.href='../../../Views/dashboard/principal/publicaciones';</script>";
    }
    public function ActualizarPublicacion($id)
    {

        require '../../../Models/dao/conexion.php';
        //Captura id
        $nombre = $_POST['nombre'];
        $descripcion = $_POST['descripcion'];
        $costo = $_POST['costo'];
        $stock = $_POST['stock'];
        //Sentencia sql
        $sql = "CALL sp_actualizarPublicacion (:nombre,:descripcion,:costo,:stock,:id)";
        //Preparar la consulta
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(":nombre", $nombre);
        $stmt->bindValue(":descripcion", $descripcion);
        $stmt->bindValue(":costo", $costo);
        $stmt->bindValue(":stock", $stock);
        $stmt->bindValue(":id", $id);
        //Ejecutar
        $stmt->execute();
        //Redireccionar
        echo "<script>alert('Publicación actualizada correctamente');</script>";
        echo "<script> document.location.href='../../../Views/dashboard/principal/misPublicaciones';</script>";
    }
    public function EliminarPublicacion($id)
    {

        require '../../../Models/dao/conexion.php';
        //sentencia sql para eliminar Imagen
        $sqlEliminar = "CALL sp_eliminarImagenPublicacion (:id)";
        $consultaEliminar = $pdo->prepare($sqlEliminar);
        $consultaEliminar->bindValue(":id", $id);
        $consultaEliminar->execute();

        //sentencia sql para eliminar Publicación
        $sqlEliminar = "CALL sp_eliminarPublicacion (:id)";
        $consultaEliminar = $pdo->prepare($sqlEliminar);
        $consultaEliminar->bindValue(":id", $id);
        $consultaEliminar->execute();
        //Redireccionar
        echo "<script>alert('Publicación eliminada correctamente');</script>";
        echo "<script> document.location.href='../../../Views/dashboard/principal/misPublicaciones';</script>";
    }
    public function MostrarPublicacion($id)
    {

        require '../../Models/dao/conexion.php';
        $sql = "CALL sp_mostrarPublicacionIndex(:id)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(":id", $id);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    public function MostrarImgPublicacion($id)
    {

        require '../../Models/dao/conexion.php';
        $sql = "CALL sp_mostrarImgPublicacion(:id)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(":id", $id);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    public function FiltroPublicacion($id)
    {
        require '../../Models/dao/conexion.php';
        $sql = "CALL sp_filtroPublicacion(:id)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(":id", $id);
        $stmt->execute();
        return $stmt->fetchAll();
    }
}
function MostrarCategorias()
{
    require '../../Models/dao/conexion.php';
    /* Lista desplegable de categoría */
    $sqlCategoria = "CALL sp_mostrarCategorias()";
    //Prepara sentencia
    $consultarCategoria = $pdo->prepare($sqlCategoria);
    //Ejecutar consulta
    $consultarCategoria->execute();
    $resultadoCategoria = $consultarCategoria->fetchAll();
    return $resultadoCategoria;
}
