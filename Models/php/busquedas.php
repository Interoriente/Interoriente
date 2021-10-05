<?php
if (isset($_POST['busqueda'])) {
   $res = buscarElemento($_POST['busqueda']);
   echo $res;
}else if(isset($_POST['publicacion'])){
    $id = base64_encode($_POST['publicacion']);
    echo $id;

    //Nota: incluso si se usa decode, si es un objeto enviado desde el cliente, se debe seguir usando la notación -> para acceder
}
function buscarElemento($keyWord){
    require '../dao/conexion.php';
    $sql = "CALL sp_busquedas(:keyword)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':keyword', $keyWord);
    $stmt->execute();
    $res = json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
    return $res;
}
