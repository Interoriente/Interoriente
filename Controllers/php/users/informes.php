<?php
class Informes
{
    /* Atributos */
    public int $docId;

    /* Constructor */
    public function __construct(int $id)
    {
        $this->id = $id;
    }

    public function MostrarVentasAnuales($id)
    {
        require "../../../Models/dao/conexion.php";
        $sqlDatos = "SELECT month(FA.fechaFactura) AS 'Mes', 
        SUM(FP.cantidadFacturaPublicacion * PU.costoPublicacion) AS 'Total'
        FROM tblFactura AS FA
        INNER JOIN tblFacturaPublicacion AS FP
        ON FP.numFacturaPublicacion = FA.numeroFactura
        INNER JOIN tblPublicacion AS PU 
        ON PU.idPublicacion = FP.idPublicacionFactura
        WHERE YEAR(FA.fechaFactura) = YEAR(CURDATE()) AND docIdentidadPublicacion = ?
        GROUP BY month(FA.fechaFactura)";
        $stmtDatos = $pdo->prepare($sqlDatos);
        $stmtDatos->execute(array($id));
        return $stmtDatos->fetchAll();
    }
    public function VentasPorDias($id)
    {
        require "../../../Models/dao/conexion.php";
        $sqlDatosSemana = "SELECT DAY(FA.fechaFactura) as 'Dia', COUNT(FA.numeroFactura) as 'Total'
        FROM tblFactura as FA
        INNER JOIN tblFacturaPublicacion as FP
        ON FP.numFacturaPublicacion=FA.numeroFactura
        INNER JOIN tblPublicacion AS PU ON PU.idPublicacion = FP.idPublicacionFactura 
        WHERE FA.fechaFactura BETWEEN DATE_SUB(NOW(),INTERVAL 7 DAY) 
        AND NOW() AND PU.docIdentidadPublicacion=?
        GROUP BY DAY(FA.fechaFactura)";
        $stmtDatosSemana = $pdo->prepare($sqlDatosSemana);
        $stmtDatosSemana->execute(array($id));
        return $stmtDatosSemana->fetchAll();
    }
}
