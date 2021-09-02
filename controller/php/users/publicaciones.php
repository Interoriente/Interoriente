<?php
if (isset($_POST['crearPublicacion'])) {
    /* Capturar datos */
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $color = $_POST['color'];
    $costo = $_POST['costo'];
    $estadoArticulo = $_POST['estado'];
    $stock = $_POST['stock'];
    $categoria = $_POST['categoria'];
    $documentoIdentidad = $_POST['usuario'];
    /* Instanciar clase */
    $publicaciones = new Publicaciones($documentoIdentidad);
    /* Llamar función */
    $publicaciones->CrearPublicacion(
        $nombre,
        $descripcion,
        $color,
        $costo,
        $estadoArticulo,
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
    public function ContarPublicaciones($docId)
    {
        require '../../../model/dao/conexion.php';
        $sqlSesionPubli = "SELECT * 
        FROM tblPublicacion 
        WHERE docIdentidadPublicacion = ?";
        $consultaSesionPubli = $pdo->prepare($sqlSesionPubli);
        $consultaSesionPubli->execute(array($docId));
        return $resultadoSesionPubli = $consultaSesionPubli->rowCount();
    }

    public function MostrarPublicaciones($docId)
    {
        require '../../../model/dao/conexion.php';

        $sqlPubli = "SELECT *
        FROM tblPublicacion as PU
        INNER JOIN tblImagenes 
        as IMG ON PU.idPublicacion = IMG.publicacionImagen
        WHERE docIdentidadPublicacion = ?
        GROUP BY PU.nombrePublicacion, PU.descripcionPublicacion,PU.costoPublicacion
        ORDER BY nombrePublicacion asc";
        //Prepara sentencia
        $consultarPubli = $pdo->prepare($sqlPubli);
        //Ejecutar consulta
        $consultarPubli->execute(array($docId));
        return $consultarPubli->fetchAll();
    }

    public function getEstados()
    {
        require '../../../model/dao/conexion.php';
        /* Lista desplegable de los estados de artículos */
        $sqlEstado = "SELECT * FROM tblEstadoArticulo ORDER BY nombreEstadoArticulo ASC";
        //Prepara sentencia
        $consultarEstado = $pdo->prepare($sqlEstado);
        //Ejecutar consulta
        $consultarEstado->execute();
        $resultadoEstado = $consultarEstado->fetchAll();
        return $resultadoEstado;
    }

    public function getCategorias()
    {
        require '../../../model/dao/conexion.php';
        /* Lista desplegable de categoría */
        $sqlCategoria = "SELECT * 
        FROM tblCategoria ORDER BY nombreCategoria ASC";
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
        $colorPubli,
        $costoPubli,
        $estadoArticuloPubli,
        $stockPubli,
        $categoriaPubli,
        $documentoIdentidadPubli
    ) {
        require '../../model/dao/conexion.php';

        $verificacion = '0';
        //sentencia SQL
        $sql = "INSERT 
        INTO tblPublicacion 
        (nombrePublicacion,docIdentidadPublicacion,
        descripcionPublicacion,colorPublicacion,
        costoPublicacion,estadoArticuloPublicacion,
        stockPublicacion,categoriaPublicacion,validacionPublicacion)
        VALUES (?,?,?,?,?,?,?,?,?)";
        //Preparar consulta
        $insertarPublicacion = $pdo->prepare($sql);
        //Almaceno información
        $insertarPublicacion->execute(array(
            $nombrePubli, $documentoIdentidadPubli,
            $descripcionPubli, $colorPubli, $costoPubli, $estadoArticuloPubli,
            $stockPubli, $categoriaPubli, $verificacion
        ));

        //Seleccionar último id en la BD
        $idPublicacion = ($pdo->lastInsertId());
        $idPubli = "id" . $idPublicacion . "_";

        $cantidad = count($_FILES['imagen']['tmp_name']);
        //Ejecutar la sentencia
        for ($i = 0; $i < $cantidad; $i++) {
            //Comprobamos si el fichero es una imagen
            if ($_FILES['imagen']['type'][$i] == 'image/png' || $_FILES['imagen']['type'][$i] == 'image/jpeg' || $_FILES['imagen']['type'][$i] == 'image/jpg') {
                //Le defino una ruta a la imagen
                $directorio = "../../view/assets/img/publicaciones/$idPubli";
                //Nombre de la imagen
                $filename = $_FILES['imagen']['name'][$i];
                //Nombre temporal de la imagen -> Por defecto se necesita este paso.
                $temporal = $_FILES['imagen']['tmp_name'][$i];
                $ruta = $directorio . "" . basename($filename);
                //Especifico el nombre que se va a guardar en la BD
                $archivo = $idPubli . $filename;
                //Subimos la imagen al servidor
                if (move_uploaded_file($temporal, $ruta)) {
                    //Insertando imagen en la tabla
                    $sqlInsertarImagen = "INSERT 
                    INTO tblImagenes (urlImagen, publicacionImagen)
                    VALUES (?,?)";
                    $insertarImagen = $pdo->prepare($sqlInsertarImagen);
                    $resultado = $insertarImagen->execute(array($archivo, $idPublicacion));

                    /* Validar ejecución exitosa de la sentencia */

                    echo "<script>alert('El registro se subió correctamente');</script>";
                    /* Redirigir después de almacenar la información */
                    echo "<script> document.location.href='../../view/dashboard/principal/crearPublicacion.php';</script>";
                    //sleep(5);
                } else {
                    echo "Error moviendo archivo";
                }
            } else {
                echo "<script>alert('Error: formato de imagen no válido');</script>";
                echo "<script> document.location.href='../../view/dashboard/principal/crearPublicacion.php';</script>";
            }
        }
    }
    public function MostrarTodasPublicaciones()
    {
        require "../../../model/dao/conexion.php";

        $sqlMostrarPubli = "SELECT * 
        FROM tblPublicacion as PU
        INNER JOIN tblImagenes as IMG 
        ON PU.idPublicacion = IMG.publicacionImagen
        GROUP BY PU.nombrePublicacion, PU.descripcionPublicacion,PU.costoPublicacion 
        ORDER BY nombrePublicacion asc"; //Prepara sentencia

        $consultarMostrarPubli = $pdo->prepare($sqlMostrarPubli);
        //Ejecutar consultas
        $consultarMostrarPubli->execute();

        return $consultarMostrarPubli->fetchAll();
    }
    public function ActivarPublicacion($docId)
    {
        //Llamada a la conexion
        require '../../model/dao/conexion.php';
        $estado = '1';
        //sentencia sql para actualizar estado
        $sqlActivar = "UPDATE tblPublicacion 
        SET validacionPublicacion = ? 
        WHERE idPublicacion = ?";
        $activar = $pdo->prepare($sqlActivar);
        $activar->execute(array($estado, $docId));

        // TODO Comprobar existencia de excepciones

        echo "<script>alert('Estado actualizado correctamente');</script>";
        //redireccionar
        echo "<script> document.location.href='../../view/dashboard/principal/publicaciones.php';</script>";
    }

    public function DesactivarPublicacion($id)
    {
        //Llamada a la conexion
        require '../../model/dao/conexion.php';
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
        echo "<script> document.location.href='../../view/dashboard/principal/publicaciones.php';</script>";
    }
    public function ActualizarPublicacion($id)
    {
        require '../../model/dao/conexion.php';
        //Captura id
        $nombre = $_POST['nombre'];
        $descripcion = $_POST['descripcion'];
        $costo = $_POST['costo'];
        $stock = $_POST['stock'];
        //Sentencia sql
        $sql = "UPDATE tblPublicacion SET nombrePublicacion=?,descripcionPublicacion=?,costoPublicacion=?,stockPublicacion=? WHERE idPublicacion=?";
        //Preparar la consulta
        $stmt = $pdo->prepare($sql);
        //Ejecutar
        $stmt->execute(array($nombre, $descripcion, $costo, $stock, $id));
        //Redireccionar
        echo "<script>alert('Publicación actualizada correctamente');</script>";
        echo "<script> document.location.href='../../view/dashboard/principal/crearPublicacion.php';</script>";
    }
    public function EliminarPublicacion($id)
    {

        require '../../model/dao/conexion.php';
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
        echo "<script> document.location.href='../../view/dashboard/principal/crearPublicacion.php';</script>";
    }
}