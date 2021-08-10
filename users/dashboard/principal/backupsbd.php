<?php
session_start();
if ($_SESSION['roles'] == '3') {

    include_once '../../../dao/conexion.php';
    /* $fecha = date('Y-m-d H:i:s');
    $salidaSql = $nombreBD . '_' . $fecha . '.sql';
    //$dump = "mysqldump -u $usuario -p$contrasena $nombreBD > C:\xampp\htdocs\Interoriente\prueba1.sql";
    //system($dump, $output);
    //funciona en simbolo de sistema->mysqldump -u root -p interori_inteoriente > C:\xampp\htdocs\Interoriente\prueba.sql

    $command = 'mysqldump --opt -h' . $nombrehost . ' -u' . $usuario . ' --password="' . $contrasena . '" ' . $nombreBD . ' > ' . $salidaSql;
    exec($command, $output, $worked);
    switch ($worked) {
        case 0:
            echo 'La base de datos <b>' . $nombreBD . '</b> se ha almacenado correctamente en la siguiente ruta ' . getcwd() . '/' . $salidaSql . '</b>';
            break;
        case 1:
            echo 'Se ha producido un error al exportar <b>' . $nombreBD . '</b> a ' . getcwd() . '/' . $salidaSql . '</b>';
            break;
        case 2:
            echo 'Se ha producido un error de exportación, compruebe la siguiente información: <br/><br/><table><tr><td>Nombre de la base de datos:</td><td><b>' . $nombreBD . '</b></td></tr><tr><td>Nombre de usuario MySQL:</td><td><b>' . $usuario . '</b></td></tr><tr><td>Contraseña MySQL:</td><td><b>NOTSHOWN</b></td></tr><tr><td>Nombre de host MySQL:</td><td><b>' . $nombrehost . '</b></td></tr></table>';
            break;
    }
 */
    // file header stuff
    $output = "-- PHP MySQL Dump\n--\n";
    $output .= "-- Host: $host\n";
    $output .= "-- Generated: " . date("r", time()) . "\n";
    $output .= "-- PHP Version: " . phpversion() . "\n\n";
    $output .= "SET SQL_MODE=\"NO_AUTO_VALUE_ON_ZERO\";\n\n";
    $output .= "--\n-- Database: `$nombreBD`\n--\n";
    // get all table names in db and stuff them into an array
    $tables = array();
    $stmt = $pdo->query("SHOW TABLES");
    while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
        $tables[] = $row[0];
    }
    // process each table in the db
    foreach ($tables as $table) {
        $fields = "";
        $sep2 = "";
        $output .= "\n-- " . str_repeat("-", 60) . "\n\n";
        $output .= "--\n-- Table structure for table `$table`\n--\n\n";
        // get table create info
        $stmt = $pdo->query("SHOW CREATE TABLE $table");
        $row = $stmt->fetch(PDO::FETCH_NUM);
        $output .= $row[1] . ";\n\n";
        // get table data
        $output .= "--\n-- Dumping data for table `$table`\n--\n\n";
        $stmt = $pdo->query("SELECT * FROM $table");
        while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
            // runs once per table - create the INSERT INTO clause
            if ($fields == "") {
                $fields = "INSERT INTO `$table` (";
                $sep = "";
                // grab each field name
                foreach ($row as $col => $val) {
                    $fields .= $sep . "`$col`";
                    $sep = ", ";
                }
                $fields .= ") VALUES";
                $output .= $fields . "\n";
            }
            // grab table data
            $sep = "";
            $output .= $sep2 . "(";
            foreach ($row as $col => $val) {
                // add slashes to field content
                $val = addslashes($val);
                // replace stuff that needs replacing
                $search = array("\'", "\n", "\r");
                $replace = array("''", "\\n", "\\r");
                $val = str_replace($search, $replace, $val);
                $output .= $sep . "'$val'";
                $sep = ", ";
            }
            // terminate row data
            $output .= ")";
            $sep2 = ",\n";
        }
        // terminate insert data
        $output .= ";\n";
    }
    // output file to browser
    header('Content-Description: File Transfer');
    header('Content-type: application/octet-stream');
    header('Content-Disposition: attachment; filename=' . $nombreBD . '.sql');
    header('Content-Transfer-Encoding: binary');
    header('Content-Length: ' . strlen($output));
    header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
    header('Expires: 0');
    header('Pragma: public');
    echo $output;
} else {
    echo "<script>alert('No puedes acceder a esta página con el rol que tienes');</script>";
    echo "<script> document.location.href='dashboard.php';</script>";
}
