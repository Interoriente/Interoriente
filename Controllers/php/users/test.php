<?php
finalizarCompra("Cra34", "rubenduque276");
print_r($resultadoIdFact['MAX(numeroFactura)']);
echo $resultadoIdFact['MAX(numeroFactura)'];
function finalizarCompra($direccion, $email)
{
    try {
        require('../../../Models/dao/conexion.php');
        session_start();
        $idUsuario = '123456789';
        /* Almacenar información de la compra */
        $sqlFa = "CALL sp_insertarFactura(:idUser,:direccion,:email)";
        $stmt = $pdo->prepare($sqlFa);
        $stmt->bindValue(':idUser', $idUsuario);
        $stmt->bindValue(':direccion', $direccion);
        $stmt->bindValue(':email', $email);
        $stmt->execute();
         $sqlUltIdFact = "CALL sp_ultimoNumFactura";
        $stmtIdFact = $pdo->prepare($sqlUltIdFact);
        $stmtIdFact->execute();
        $resultadoIdFact = $stmtIdFact->fetch(PDO::FETCH_OBJ);
        $idFactura = $resultadoIdFact['MAX(numeroFactura)']; 
        return $resultadoIdFact['MAX(numeroFactura)'];
        /*//Regresar el id del último registro insertado
        return "Proceso de Compras Finalizado!!";
        /* Almacenar información en tabla intermedia tblfacturapublicacion 
        $sqlCa = "CALL sp_mostrarIdCarrito(:id)";
        $stmtCa = $pdo->prepare($sqlCa);
        $stmtCa->bindValue(":id", $idUsuario);
        $stmtCa->execute();
        $respuesta = $stmtCa->fetchAll(PDO::FETCH_ASSOC);
        foreach ($respuesta as $fila) {
            $idPubli = $fila['idPu'];
            $cantidad = $fila['cantidad'];
            $sqlFacPu = "CALL sp_insertarFacturaPublicacion (:idFact, :idPubli, :cantidad)";
            $stmtFacPu = $pdo->prepare($sqlFacPu);
            $stmtFacPu->bindValue(':idFact', $idFactura);
            $stmtFacPu->bindValue(':idPubli', $idPubli);
            $stmtFacPu->bindValue(':cantidad', $cantidad);
            $stmtFacPu->execute();
            //Restar stock a la publicación
            $sqlStock = "CALL sp_actualizarExistencia(:id,:cantidad";
            $stmtStock = $pdo->prepare($sqlStock);
            $stmtStock->execute();
            /* Eliminar información de la tabla carrito 
            $sqlDeleteCart = "CALL sp_borrarCarrito(:id,:documento)";
            $stmtDeleteCart = $pdo->prepare($sqlDeleteCart);
            $stmtDeleteCart->bindValue(":id", $idPubli);
            $stmtDeleteCart->bindValue(":documento", $idUsuario);
            $stmtDeleteCart->execute(); */
    } catch (\Throwable $th) {
        /*echo "<script>alert('Ocurrió un error!');</script>";*/
    }
}
