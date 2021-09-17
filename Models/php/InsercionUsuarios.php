<?php
/* 
    -Hace falta definir los nombres de las direcciones LISTO
    -Cómo asiganarle una imagen al usuario? 
        resp: con esta ruta: imagenes/NO_borrar.png
*/
if (isset($_POST['usuarios'])) {
    require '../dao/conexion.php';
    $usuarios = json_decode($_POST['usuarios']);
    $contrasena = sha1('123');
    $estado = '1';
    $img = 'imagenes/NO_borrar.png';
    foreach ($usuarios as $usuario) {
        $docId = $usuario->id;
        $nombre = $usuario->name;
        $apellido = $usuario->lastname;
        $telefono = $usuario->phone_h;
        $email = $usuario->email_u;
        $direccion = $usuario->address;
        $sql = "INSERT INTO tblUsuario 
        VALUES (:id, :nombre, :apellido, :tel, :email, :pass, null, :estado, :img)";
        $stmtUs = $pdo->prepare($sql);
        $stmtUs->bindValue(':id', $docId);
        $stmtUs->bindValue(':nombre', $nombre);
        $stmtUs->bindValue(':apellido', $apellido);
        $stmtUs->bindValue(':tel', $telefono);
        $stmtUs->bindValue(':email', $email);
        $stmtUs->bindValue(':pass', $contrasena);
        $stmtUs->bindValue(':estado', $estado);
        $stmtUs->bindValue(':img', $img);
        $stmtUs->execute();
    }

    function getCiudades(){
        require '../dao/conexion.php';
        $sql = "SELECT idCiudad FROM tblCiudad";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $resultado;
    }
    function setDireccion(){
        /* TODO: LLamar info de la tbl usuarios para asignar id */
        //$numCiudades = sizeof($ciudades);
        require '../dao/conexion.php';
        $direcciones = ["Casa", "Oficina"];
        $sqlc = "SELECT idCiudad FROM tblCiudad";
        $stmt = $pdo->prepare($sqlc);
        $stmt->execute();
        $ciudades = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $nombreDir = $direcciones[rand(0,1)]; 
        $ciudadDir = $ciudades[rand(0, $numCiudades)];
        $sqlDir = "INSERT INTO tblDirecciones
        VALUES (null, $docId, $nombreDir, $direccion, $ciudadDir)";
        $stmtDir = $pdo->prepare($sqlDir);
        $stmtDir->execute();
    }
}




