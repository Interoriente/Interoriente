<?php
if (isset($_POST['busqueda'])) {
    $res = buscarElemento($_POST['busqueda'], 0);
    echo $res;
} else {
    // No valido con else if
    if (isset($_POST['publicacion'])) {
        $id = base64_encode($_POST['publicacion']);
        echo $id;
    }else if(isset($_POST['getResultados'])){
        $res = buscarElemento($_POST['getResultados'], 1);
        echo $res;
    } 

    //Nota: incluso si se usa decode, si es un objeto enviado desde el cliente, se debe seguir usando la notación -> para acceder
}
function buscarElemento($keyWord, $val)
{
    require '../dao/conexion.php';
    if ($val == 0) {
        $sql = "CALL sp_busquedas(:keyword)";
    }else{
        $sql = "CALL sp_busquedaPublicacion(:keyword)";
    }
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':keyword', $keyWord);
    $stmt->execute();
    $res = json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
    return $res;
}
