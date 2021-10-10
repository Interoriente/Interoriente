<?php
if (isset($_POST['crearPublicacion'])) {
    /* Capturar datos */
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $costo = $_POST['costo'];
    $stock = $_POST['stock'];
    $categoria = $_POST['categoria'];
    $documentoIdentidad = $_POST['usuario'];
    /* Instanciar clase */
    $publicaciones = new Publicaciones($documentoIdentidad);
    /* Llamar función */
    $publicaciones->CrearPublicacion(
        $nombre,
        $descripcion,
        $costo,
        $stock,
        $categoria,
        $documentoIdentidad
    );
} else if (isset($_POST['activarPublicacion'])) {
    $id = $_POST['id'];
    $publicacion = new Publicaciones($id);
    $publicacion->ActivarPublicacion($publicacion->id);
} else if (isset($_POST['desactivarPublicacion'])) {
    $id = $_POST['id'];
    $publicacion = new Publicaciones($id);
    $publicacion->DesactivarPublicacion($publicacion->id);
} else if (isset($_POST['actualizarPublicacion'])) {
    $id = $_POST['idPublicacion'];
    $publicacion = new Publicaciones($id);
    $publicacion->ActualizarPublicacion($publicacion->id);
} else if (isset($_POST['eliminarPublicacion'])) {
    $id = $_POST['idPublicacion'];
    $publicacion = new Publicaciones($id);
    $publicacion->EliminarPublicacion($publicacion->id);
}
class Publicaciones
{
    public int $docId;
    public function __construct($docId)
    {
        $this->id = $docId;
    }

    public function MostrarPublicaciones($docId)
    {
        try {
            require '../../../Models/dao/conexion.php';
            $sqlPubli = "CALL sp_mostrarPublicaciones(:id)";
            //Prepara sentencia
            $consultarPubli = $pdo->prepare($sqlPubli);
            $consultarPubli->bindValue(":id", $docId);
            //Ejecutar consulta
            $consultarPubli->execute();
            return $consultarPubli->fetchAll();
        } catch (\Throwable $th) {
            echo "<script>alert('Ocurrió un error');</script>";
        }
    }

    public function getEstados()
    {
        try {
            require '../../../Models/dao/conexion.php';
            /* Lista desplegable de los estados de artículos */
            $sqlEstado = "CALL sp_mostrarEstados()";
            //Prepara sentencia
            $consultarEstado = $pdo->prepare($sqlEstado);
            //Ejecutar consulta
            $consultarEstado->execute();
            $resultadoEstado = $consultarEstado->fetchAll();
            return $resultadoEstado;
        } catch (\Throwable $th) {
            echo "<script>alert('Ocurrió un error');</script>";
        }
    }


    public function getCategorias()
    {
        try {
            require '../../../Models/dao/conexion.php';
            /* Lista desplegable de categoría */
            $sqlCategoria = "CALL sp_mostrarCategorias()";
            //Prepara sentencia
            $consultarCategoria = $pdo->prepare($sqlCategoria);
            //Ejecutar consulta
            $consultarCategoria->execute();
            $resultadoCategoria = $consultarCategoria->fetchAll();
            return $resultadoCategoria;
        } catch (\Throwable $th) {
            echo "<script>alert('Ocurrió un error');</script>";
        }
    }



    public function CrearPublicacion(
        $nombrePubli,
        $descripcionPubli,
        $costoPubli,
        $stockPubli,
        $categoriaPubli,
        $documentoIdentidadPubli
    ) {
        try {

            require '../../../Models/dao/conexion.php';
            $verificacion = '0';
            //sentencia SQL
            $sql = "CALL sp_publicacionCrear(:nombre,:descripcion,
            :costo,:stock,:categoria,:documento,:verificacion)";
            //Preparar consulta
            $insertarPublicacion = $pdo->prepare($sql);
            $insertarPublicacion->bindValue(":nombre", $nombrePubli);
            $insertarPublicacion->bindValue(":descripcion", $descripcionPubli);
            $insertarPublicacion->bindValue(":costo", $costoPubli);
            $insertarPublicacion->bindValue(":stock", $stockPubli);
            $insertarPublicacion->bindValue(":categoria", $categoriaPubli);
            $insertarPublicacion->bindValue(":documento", $documentoIdentidadPubli);
            $insertarPublicacion->bindValue(":verificacion", $verificacion);
            //Almaceno información
            $insertarPublicacion->execute();
            $insertarPublicacion->closeCursor();

            //Seleccionar último id en la BD
            $idPublicacion = ($pdo->lastInsertId());
            echo $idPublicacion;
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
                    $archivo = "../../assets/img/publicaciones/$idPubli" . $filename;
                    //Subimos la imagen al servidor
                    if (move_uploaded_file($temporal, $ruta)) {
                        //Insertando imagen en la tabla
                        $sqlInsertarImagen = "CALL sp_imagenInsertar(:url,:publicacion)";
                        $insertarImagen = $pdo->prepare($sqlInsertarImagen);
                        $insertarImagen->bindValue(":url", $archivo);
                        $insertarImagen->bindValue(":publicacion", $idPublicacion);
                        $resultado = $insertarImagen->execute();

                        /* Validar ejecución exitosa de la sentencia */

                        echo "<script>alert('El registro se subió correctamente');</script>";
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
        } catch (\Throwable $th) {
            echo $th->getMessage();
            /* echo "<script> document.location.href='../../../Views/dashboard/principal/crearPublicacion.php';</script>"; */
        }
    }
    public function MostrarTodasPublicaciones()
    {
        try {
            require "../../../Models/dao/conexion.php";
            $sqlMostrarPubli = "SELECT IMG.urlImagen,PU.idPublicacion,PU.nombrePublicacion,PU.descripcionPublicacion,
            PU.costoPublicacion,PU.stockPublicacion,PU.validacionPublicacion
            FROM tblPublicacion as PU
            INNER JOIN tblImagenes as IMG 
            ON PU.idPublicacion = IMG.publicacionImagen
            GROUP BY PU.nombrePublicacion, PU.descripcionPublicacion,PU.costoPublicacion 
            ORDER BY nombrePublicacion asc"; //Prepara sentencia

            $consultarMostrarPubli = $pdo->prepare($sqlMostrarPubli);
            //Ejecutar consultas
            $consultarMostrarPubli->execute();

            return $consultarMostrarPubli->fetchAll();
        } catch (\Throwable $th) {
            echo "<script>alert('Ocurrió un error');</script>";
        }
    }
    public function ActivarPublicacion($docId)
    {
        try {
            //Llamada a la conexion
            require '../../../Models/dao/conexion.php';
            $estado = '1';
            //sentencia sql para actualizar estado
            $sqlActivar = "UPDATE tblPublicacion 
            SET validacionPublicacion = ? 
            WHERE idPublicacion = ?";
            $activar = $pdo->prepare($sqlActivar);
            $activar->execute(array($estado, $docId));

            echo "<script>alert('Estado actualizado correctamente');</script>";
            echo "<script> document.location.href='../../../Views/dashboard/principal/publicaciones.php';</script>";
        } catch (\Throwable $th) {
            /*echo "<script>alert('Ocurrió un error!');</script>";*/
            echo "<script> document.location.href='../../../Views/dashboard/principal/publicaciones.php';</script>";
        }
    }

    public function DesactivarPublicacion($id)
    {
        try {
            //Llamada a la conexion
            require '../../../Models/dao/conexion.php';
            $estado = '0';
            //sentencia sql para actualizar estado
            $sqlEditar = "UPDATE tblPublicacion 
            SET validacionPublicacion = ?  
            WHERE idPublicacion = ?";
            $consultaEditar = $pdo->prepare($sqlEditar);
            $consultaEditar->execute(array($estado, $id));
            //alert
            echo "<script>alert('Estado actualizado correctamente');</script>";
            //redireccionar
            echo "<script> document.location.href='../../../Views/dashboard/principal/publicaciones.php';</script>";
        } catch (\Throwable $th) {
            /*echo "<script>alert('Ocurrió un error!');</script>";*/
            echo "<script> document.location.href='../../../Views/dashboard/principal/publicaciones.php';</script>";
        }
    }
    public function ActualizarPublicacion($id)
    {
        try {
            require '../../../Models/dao/conexion.php';
            //Captura id
            $nombre = $_POST['nombre'];
            $descripcion = $_POST['descripcion'];
            $costo = $_POST['costo'];
            $stock = $_POST['stock'];
            //Sentencia sql
            $sql = "UPDATE tblPublicacion1 SET nombrePublicacion=?,descripcionPublicacion=?,costoPublicacion=?,stockPublicacion=? WHERE idPublicacion=?";
            //Preparar la consulta
            $stmt = $pdo->prepare($sql);
            //Ejecutar
            $stmt->execute(array($nombre, $descripcion, $costo, $stock, $id));
            //Redireccionar
            echo "<script>alert('Publicación actualizada correctamente');</script>";
            echo "<script> document.location.href='../../../Views/dashboard/principal/misPublicaciones.php';</script>";
        } catch (\Throwable $th) {
            /*echo "<script>alert('Ocurrió un error!');</script>";*/
            echo "<script> document.location.href='../../../Views/dashboard/principal/misPublicaciones.php';</script>";
        }
    }
    public function EliminarPublicacion($id)
    {
        try {
            require '../../../Models/dao/conexion.php';
            //sentencia sql para eliminar Imagen
            $sqlEliminar = "DELETE FROM tblImagenes WHERE publicacionImagen = ?";
            $consultaEliminar = $pdo->prepare($sqlEliminar);
            $consultaEliminar->execute(array($id));

            //sentencia sql para eliminar Publicación
            $sql_eliminar = "DELETE FROM tblPublicacion WHERE idPublicacion = ?";
            $consulta_eliminar = $pdo->prepare($sql_eliminar);
            $consulta_eliminar->execute(array($id));
            //Redireccionar
            echo "<script>alert('Publicación eliminada correctamente');</script>";
            echo "<script> document.location.href='../../../Views/dashboard/principal/misPublicaciones.php';</script>";
        } catch (\Throwable $th) {
            /*echo "<script>alert('Ocurrió un error!');</script>";*/
            echo "<script> document.location.href='../../../Views/dashboard/principal/misPublicaciones.php';</script>";
        }
    }
    public function MostrarPublicacion($id)
    {
        try {

            require '../../Models/dao/conexion.php';
            $sql = "CALL sp_mostrarPublicaciones(:id)";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(":id", $id);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (\Throwable $th) {
            header("Location: ../../Views/navegacion/index.php");
        }
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
    try {
        require '../../Models/dao/conexion.php';
        /* Lista desplegable de categoría */
        $sqlCategoria = "SELECT *
                        FROM tblCategoria 
                        ORDER BY nombreCategoria ASC";
        //Prepara sentencia
        $consultarCategoria = $pdo->prepare($sqlCategoria);
        //Ejecutar consulta
        $consultarCategoria->execute();
        $resultadoCategoria = $consultarCategoria->fetchAll();
        return $resultadoCategoria;
    } catch (\Throwable $th) {
        /* echo "<script>alert('Ocurrió un error');</script>"; */
    }
}
