<?php
if (isset($_POST['filtroFechasExitosas'])) {
    $fechas = json_decode($_POST['filtroFechasExitosas']);
    session_start();
    if (isset($_SESSION['documentoIdentidad'])) {
        $informe = new Informes($_SESSION['documentoIdentidad'], 0);
        echo json_encode($informe->GetPublicacionesExitosas($informe->id, $informe->val, $fechas));
    }
}
class Informes
{
    /* Atributos */
    public int $id;
    public int $val;

    /* Constructor */
    public function __construct(int $id, int $val)
    {
        $this->id = $id;
        $this->val = $val;
    }
    public function ContadorStock($id)
    {
        try {
            require "../../../Models/dao/conexion.php";
            $sql = "CALL sp_contadorStock(:id)";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(":id", $id);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (\Throwable $th) {
            /*echo "<script>alert('Ocurrió un error!');</script>";*/
        }
    }
    public function MostrarVentasAnuales($id)
    {
        require "../../../Models/dao/conexion.php";
        $sql = "CALL sp_ventasAnuales(:id)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(":id", $id);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    public function VentasPorDias($id)
    {
        require "../../../Models/dao/conexion.php";
        $sql = "CALL sp_ventasPorDia(:id)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(":id", $id);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    public function GetPublicacionesExitosas($id, $val, $fechas)
    {
        /* Mostrar publicaciones más exitosas */
        /* Dado el caso que se pida la  */
        require "../../../Models/dao/conexion.php";
        $reporte = [
            'Ids' => null, 'Titulos' => null, 'NoVentas' => null,
            "VlrVentas" => null, "Stock" => null, "Porcentajes" => null
        ];
        $check = false;
        $objReporte = (object) $reporte;
        $ids = [];
        $titulos = [];
        $NoVentas = [];
        $TotalVentas = [];
        $Cantidad = [];
        $totsPublicaciones = [];
        $porcentajes = [];
        if ($val) {
            $sql = "CALL sp_publicacionesMasExitosas(:id)";
        } else {
            $sql = "CALL sp_publicacionesExitosasFechas(:id, :inicial, :final)";
            $check = true;
        }
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(":id", $id);

        if ($check) {
            $stmt->bindValue(":inicial", $fechas->inicial);
            $stmt->bindValue(":final", $fechas->final);
        }

        $stmt->execute();
        $masExitosas = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        foreach ($masExitosas as $publicacion) {
            array_push($ids, $publicacion['Id']);
            array_push($titulos, $publicacion['Titulo']);
            array_push($NoVentas, $publicacion['CantidadVentas']);
            array_push($TotalVentas, $publicacion['VlrVentas']);
            array_push($Cantidad, $publicacion['Cantidad']);
        }

        $objReporte->Ids = $ids;
        $objReporte->Titulos = $titulos;
        $objReporte->NoVentas = $NoVentas;
        $objReporte->VlrVentas = $TotalVentas;
        $objReporte->Cantidad = $Cantidad;
        foreach ($ids as $index) {
            $sqlPorcentaje = "SELECT SUM(FP.cantidadFacturaPublicacion * PU.costoPublicacion) AS 'Total'
                FROM tblPublicacion as PU
                INNER JOIN tblFacturaPublicacion AS FP 
                ON PU.idPublicacion = FP.idPublicacionFactura
                WHERE PU.idPublicacion = :id
                GROUP BY FP.idPublicacionFactura";
            $stmtPorcentaje = $pdo->prepare($sqlPorcentaje);
            $stmtPorcentaje->bindValue(':id', $index);
            $stmtPorcentaje->execute();
            array_push($totsPublicaciones, $stmtPorcentaje->fetchAll(PDO::FETCH_ASSOC));
        }
        /* Regla de 3:
            1. Obtener Total (TG)
            2. Obtener el Total de la publicación (TP)
            3. Multiplicar TP * 100 / TG; */
        $sqlTotalG = "CALL sp_totalGeneral (:id)";
        $stmtTotalG = $pdo->prepare($sqlTotalG);
        $stmtTotalG->bindValue(":id", $id);
        $stmtTotalG->execute();
        $totalGeneral = $stmtTotalG->fetchAll(PDO::FETCH_ASSOC);
        $totalGeneral = $totalGeneral[0]["Total"];
        for ($i = 0; $i < count($totsPublicaciones); $i++) {
            $calculo = ($totsPublicaciones[$i][0]["Total"] * 100) / $totalGeneral;
            array_push($porcentajes, $calculo);
        }
        //Al final
        $objReporte->Porcentajes = $porcentajes;
        return $objReporte;
    }
    public function AlertaStock($id)
    {
        require "../../../Models/dao/conexion.php";
        $sql = "CALL sp_contadorStock(:id)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(":id", $id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function VentasHoy($id)
    {
        require "../../../Models/dao/conexion.php";
        $sql = "CALL sp_ventasHoy(:id)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(":id", $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function NoValidadas($id)
    {
        require "../../../Models/dao/conexion.php";
        $sql = "CALL sp_noValidadas(:id)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(":id", $id);
        $stmt->execute();
        $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $resultado;
    }
    public function ReporteMensual($id)
    {
        //Es necesario el try, por si llegase a salir una excepción con este objeto Ej: dividir por 0
        try {
            require "../../../Models/dao/conexion.php";
            $reporte = ["TotalMesActual" => null, "Porcentaje" => null, "Subio" => 0];
            $objReporte = (object) $reporte;
            $porcentaje = 0;
            $sql = "CALL sp_totalMensual(:id)";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(":id", $id);
            $stmt->execute();
            $totalMesActual = $stmt->fetch(PDO::FETCH_ASSOC);
            $sql = "CALL sp_totalMesPasado(:id)";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(":id", $id);
            $stmt->execute();
            $totalMesPasado = $stmt->fetch(PDO::FETCH_ASSOC);
            /*             $calculoPorcentaje = ($totalMesActual["Total"] * 100) / $totalMesPasado["Total"];
 */
            $calculoPorcentaje = ($totalMesActual["Total"] * 100) / $totalMesPasado["Total"];


            if ($calculoPorcentaje < 100) {
                $porcentaje = 100 - $calculoPorcentaje;
            } else {
                if ($calculoPorcentaje > 100) {
                    $porcentaje = $calculoPorcentaje - 100;
                    $objReporte->Subio = 1;
                } else {
                    $objReporte->Subio = 3;
                }
            }

            $objReporte->TotalMesActual = $totalMesActual['Total'];
            $objReporte->Porcentaje = round($porcentaje, 2);
            return $objReporte;
        } catch (\Throwable $th) {
        }
    }
    /* Mostrar productos vendidos entre x y x fecha  */
    /* Informes para el administrador. 
    -Contador de ADMIN
    -contador de usuarios.
    -Contador publicaciones sin validar
    -Cantidad de publicaciones con poco stock
    -Usuarios inactivos
    -Reporte de publicaciones creadas 
    -Ventas generales hoy
    -Número de ventas y cantidad
    -Pu
     */
    /* Informes del Administrador */
    public function NoValidadasAdmin()
    {
        require "../../../Models/dao/conexion.php";
        $sql = "CALL sp_noValidadasAdmin";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function VentasHoyAdmin()
    {
        require "../../../Models/dao/conexion.php";
        $sql = "CALL sp_ventasHoyAdmin";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function ReporteMensualAdmin()
    {
        require "../../../Models/dao/conexion.php";
        $sql = "CALL sp_totalMensualAdmin";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function VentasAnualesAdmin()
    {
        require "../../../Models/dao/conexion.php";
        $sql = "CALL sp_ventasAnualesAdmin";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    public function VentasPorDiasAdmin()
    {
        require "../../../Models/dao/conexion.php";
        $sql = "CALL sp_ventasPorDiaAdmin";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    public function ContadorUsuarios()
    {
        require "../../../Models/dao/conexion.php";
        $sql = "CALL sp_contadorUsuarios";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function UsuariosQueMasCompran()
    {
        require "../../../Models/dao/conexion.php";
        $sql = "CALL sp_MostrarUsuarioQueMasCompran";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    /* Tratar: Tener en cuenta mostrar todo lo que sale en el dashboard*/
}
