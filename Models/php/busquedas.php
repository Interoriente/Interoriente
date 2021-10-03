<?php
if (isset($_POST['busqueda'])) {
   $res = buscarElemento($_POST['busqueda']);
   echo $res;
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
