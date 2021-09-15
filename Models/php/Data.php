<?php
/* 
Este Script es especificamente para Interlink (Extensión)
*/

if (isset($_POST['links'])) {
    require '../dao/conexion.php';
    $urls = $_POST['links'];
    /* Tabla de las urls
    */
    foreach ($urls as $link) {
        
    }
} else {
    $categorias = json_encode(getCategorias());
    echo $categorias;
}

function getCategorias(){
    require '../dao/conexion.php';
    $sql = 'SELECT idCategoria as id, nombreCategoria as nombre FROM tblCategoria';
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
