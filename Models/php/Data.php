<?php
/* 
Este Script es especificamente para Interlink (Extensión)
*/

if (isset($_POST['links'])) {
    $urls = $_POST['links'];
    setLinks($urls);
   
} else {
    $categorias = json_encode(getCategorias());
    echo $categorias;
}

function getCategorias(){
    require '../dao/conexion.php';
    $sql = 'SELECT idCategoria as id, nombreCategoria as nombre 
    FROM tblCategoria 
    ORDER BY nombreCategoria';
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function setLinks($links){
    require '../dao/conexion.php';
    /* Tabla de las urls
    Campos:
    1. id
    2. url
    3. categoria
    */
    $estado = 0;
    $arrLinks = $links;
    $categoria = array_shift($arrLinks);
    foreach ($arrLinks as $link) {
        /* $id = substr($link, 41, 9); */
        $id = substr($link, strpos($link, "MCO") + 8);
        $sql = "INSERT INTO tblLinks 
        VALUES(:id, :link, :categoria, :estado)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->bindValue(':link', $link);
        $stmt->bindValue(':categoria', $categoria);
        $stmt->bindValue(':estado', $estado);
        $stmt->execute();
        
    }
}
