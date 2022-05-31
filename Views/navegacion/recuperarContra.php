<?php
require "../../vendor/autoload.php";

//Configuración inicial de correo
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require "../../Models/dao/conexion.php";
$email = $_POST['email'];
$sql = "SELECT nombresUsuario,apellidoUsuario,contrasenaUsuario,emailUsuario FROM tblUsuario WHERE emailUsuario=:email";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(":email", $email);
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_OBJ);

if ($result) :
    try {
        //Configuración inicial de nuestro servidor
        $phpmailer = new PHPMailer();
        $phpmailer->isSMTP();
        $phpmailer->Host = 'smtp.gmail.com';
        $phpmailer->SMTPAuth = true;
        $phpmailer->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $phpmailer->Port = 465;
        $phpmailer->Username = 'interoriente437@gmail.com';
        $phpmailer->Password = 'hakqomfushvrdfmx';
        $phpmailer->isHTML(true);
        $phpmailer->CharSet = 'UTF-8';

        //Añadiendo destinatarios
        $phpmailer->setFrom('interoriente437@gmail.com', 'InterOriente');
        $phpmailer->addAddress($result->emailUsuario, $result->nombresUsuario . ' ' . $result->apellidoUsuario);

        //Desencriptar SHA1 con API
        $hash = $result->contrasenaUsuario;
        $hash_type = "sha1";
        $email = "sgomez9002@misena.edu.co";
        $code = "b725cd5a28a443b4";
        $response = file_get_contents("https://md5decrypt.net/en/Api/api.php?hash=" . $hash . "&hash_type=" . $hash_type . "&email=" . $email . "&code=" . $code);

        //Definiendo el contenido de mi email
        $phpmailer->isHTML(true);
        $phpmailer->Subject = 'Recordación de contraseña registrada en el sitio InterOriente';
        $phpmailer->Body    = 'Tu contraseña registrada es ' . $response;
        $phpmailer->AltBody = 'Tu contraseña registrada es ' . $response;

        //Mandar el correo
        $phpmailer->send();
        echo "<script>alert('Se ha enviado correctamente el correo, ¡revisalo!');</script>";
        echo "<script> document.location.href='iniciarsesion.php';</script>";
    } catch (\Throwable $th) {
        echo "<script>alert('Ocurrió un error con el servidor. {$th->ErrorInfo}');</script>";
    }
else :
    echo "<script>alert('No se ha encontrado este correo, verifica e intenta nuevamente.');</script>";
endif;
